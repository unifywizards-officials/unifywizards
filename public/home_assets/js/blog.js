document.addEventListener('DOMContentLoaded', function () {

    const blogList = document.getElementById('blog-list');
    const loader = document.getElementById('blog-loader');
    const sentinel = document.getElementById('blog-scroll-sentinel');
    const endMessage = document.getElementById('blog-end-message');
    const searchInput = document.getElementById('blog-search');

    if (!blogList) {
        console.error('Infinite scroll: #blog-list not found in DOM');
        return;
    }
    if (!sentinel) {
        console.error('Infinite scroll: #blog-scroll-sentinel not found in DOM');
        return;
    }

    // Route URL ab data attribute se milega (Blade compile nahi karta static JS files ko)
    const blogListUrl = blogList.dataset.searchUrl;

    if (!blogListUrl) {
        console.error('Infinite scroll: data-search-url missing on #blog-list');
    }

    // ---- Shared state (accessible to both scroll + search) ----
    let nextPageUrl = blogList.dataset.nextPageUrl;
    let isLoading = false;
    let currentSearch = '';
    let requestToken = 0; // guards against out-of-order responses when typing fast

    console.log('Infinite scroll initialized. Next page URL:', nextPageUrl ||
        '(none - only 1 page of results)');

    if (!nextPageUrl) {
        endMessage.style.display = 'block';
    }

    // ---- Infinite scroll observer ----
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting && nextPageUrl && !isLoading) {
                loadMorePosts();
            }
        });
    }, {
        root: null,
        rootMargin: '200px',
        threshold: 0
    });

    observer.observe(sentinel);

    // ---- Append next page (used by scroll) ----
    function loadMorePosts() {
        if (!nextPageUrl || isLoading) return;

        console.log('Fetching next page:', nextPageUrl);

        isLoading = true;
        loader.style.display = 'block';
        const myToken = requestToken;

        fetch(nextPageUrl, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error('Server returned status ' + response.status +
                            '. Response: ' + text.substring(0, 200));
                    });
                }
                return response.json();
            })
            .then(data => {
                // If a new search started while this request was in flight, ignore this stale response
                if (myToken !== requestToken) return;

                console.log('Received', data.html ? data.html.length : 0, 'chars of HTML. Next page:',
                    data.next_page_url);

                if (data.html) {
                    blogList.insertAdjacentHTML('beforeend', data.html);

                    if (typeof WOW !== 'undefined') {
                        new WOW().sync();
                    }
                }

                nextPageUrl = data.next_page_url;

                if (!nextPageUrl) {
                    endMessage.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error loading more posts:', error);
            })
            .finally(() => {
                if (myToken === requestToken) {
                    isLoading = false;
                    loader.style.display = 'none';
                }
            });
    }

    // ---- Fresh search (replaces the list instead of appending) ----
    function runSearch(search) {
        if (!blogListUrl) return;

        requestToken++; // invalidate any in-flight scroll/search request
        const myToken = requestToken;

        isLoading = true;
        loader.style.display = 'block';
        endMessage.style.display = 'none';

        const url = blogListUrl + '?search=' + encodeURIComponent(search);

        fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    return response.text().then(text => {
                        throw new Error('Server returned status ' + response.status +
                            '. Response: ' + text.substring(0, 200));
                    });
                }
                return response.json();
            })
            .then(data => {
                if (myToken !== requestToken) return; // a newer keystroke already fired, drop this response

                blogList.innerHTML = data.html && data.html.trim() !== '' ?
                    data.html :
                    '<div class="col-12 text-center"><h4>No Blogs Found</h4></div>';

                if (typeof WOW !== 'undefined') {
                    new WOW().sync();
                }

                nextPageUrl = data.next_page_url;
                endMessage.style.display = nextPageUrl ? 'none' : 'block';
            })
            .catch(error => {
                console.error('Error searching blogs:', error);
            })
            .finally(() => {
                if (myToken === requestToken) {
                    isLoading = false;
                    loader.style.display = 'none';
                }
            });
    }

    // ---- Debounced live search (waits 400ms after user stops typing) ----
    let debounceTimer = null;

    if (searchInput) {
        searchInput.addEventListener('keyup', function () {
            const value = this.value.trim();

            if (value === currentSearch) return;
            currentSearch = value;

            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => {
                runSearch(currentSearch);
            }, 400);
        });
    } else {
        console.warn('Infinite scroll: #blog-search input not found — live search disabled');
    }

});


// blog details page js\

 document.addEventListener('DOMContentLoaded', function() {

            var tocLinks = document.querySelectorAll('.toc-link');

            // ── 1. Click → smooth scroll ──
            tocLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    var targetId = this.getAttribute('data-id');
                    var target = document.getElementById(targetId);

                    if (!target) {
                        // fallback: href se try karo
                        var href = this.getAttribute('href');
                        if (href && href.startsWith('#')) {
                            target = document.getElementById(href.substring(1));
                        }
                    }

                    if (target) {
                        // sticky header ki height yahan set karo (apni site ke hisaab se)
                        var headerOffset = 100;
                        var elementTop = target.getBoundingClientRect().top + window.pageYOffset;
                        var scrollTo = elementTop - headerOffset;

                        window.scrollTo({
                            top: scrollTo,
                            behavior: 'smooth'
                        });

                        // Active class set karo
                        tocLinks.forEach(function(l) {
                            l.classList.remove('active');
                        });
                        link.classList.add('active');
                    }
                });
            });

            // ── 2. Scroll karne par auto active highlight ──
            var headings = [];
            tocLinks.forEach(function(link) {
                var id = link.getAttribute('data-id');
                var el = document.getElementById(id);
                if (el) headings.push({
                    el: el,
                    link: link
                });
            });

            if (headings.length === 0) return;

            function onScroll() {
                var scrollY = window.pageYOffset;
                var headerOffset = 120;
                var current = null;

                headings.forEach(function(item) {
                    var top = item.el.getBoundingClientRect().top + window.pageYOffset - headerOffset;
                    if (scrollY >= top) {
                        current = item;
                    }
                });

                tocLinks.forEach(function(l) {
                    l.classList.remove('active');
                });
                if (current) {
                    current.link.classList.add('active');
                }
            }

            window.addEventListener('scroll', onScroll, {
                passive: true
            });
            onScroll(); // page load par bhi run karo
        });




