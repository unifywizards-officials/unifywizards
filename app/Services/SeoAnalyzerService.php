<?php

namespace App\Services;

class SeoAnalyzerService
{
    protected string $keyword;
    protected string $title;
    protected string $metaDescription;
    protected string $url;
    protected string $content;
    protected string $introduction;
    protected array  $headings;
    protected array  $imageAlts;

    public function analyze(array $data): array
    {
        $this->keyword         = strtolower(trim($data['focus_keyword']));
        $this->title           = strtolower($data['seo_title'] ?? '');
        $this->metaDescription = strtolower($data['meta_description'] ?? '');
        $this->url             = strtolower($data['url'] ?? '');
        $this->content         = $data['content'] ?? '';
        $this->introduction    = $this->extractIntroduction($this->content);
        $this->headings        = $this->extractHeadings($this->content);
        $this->imageAlts       = $this->extractImageAlts($this->content);

        $checks = [
            $this->checkKeywordInTitle(),
            $this->checkKeywordInMetaDescription(),
            $this->checkKeywordLength(),
            $this->checkKeywordInUrl(),
            $this->checkKeywordInIntroduction(),
            $this->checkKeywordInSubheadings(),
            $this->checkKeywordInImageAlts(),
            $this->checkKeywordDensity(),
        ];

        $passed = collect($checks)->where('status', 'pass')->count();
        $score  = (int) round(($passed / count($checks)) * 100);

        return ['score' => $score, 'checks' => $checks];
    }

    private function checkKeywordInTitle(): array
    {
        $pass = str_contains($this->title, $this->keyword);
        return [
            'label'   => 'Focus Keyword in SEO Title',
            'status'  => $pass ? 'pass' : 'fail',
            'message' => $pass
                ? 'Focus keyword found in SEO title.'
                : 'Focus keyword not found in SEO title.',
        ];
    }

    private function checkKeywordInMetaDescription(): array
    {
        $pass = str_contains($this->metaDescription, $this->keyword);
        return [
            'label'   => 'Focus Keyword in Meta Description',
            'status'  => $pass ? 'pass' : 'fail',
            'message' => $pass
                ? 'Focus keyword found in meta description.'
                : 'Add the focus keyword to your meta description.',
        ];
    }

    private function checkKeywordLength(): array
    {
        $words = str_word_count($this->keyword);
        $pass  = $words >= 1 && $words <= 4;
        return [
            'label'   => 'Focus Keyword Length',
            'status'  => $pass ? 'pass' : 'warn',
            'message' => $pass
                ? 'Good keyword length!'
                : 'Focus keyword should be 1 to 4 words.',
        ];
    }

    private function checkKeywordInUrl(): array
    {
        $slug = str_replace([' ', '_'], '-', $this->keyword);
        $pass = str_contains($this->url, $slug);
        return [
            'label'   => 'Focus Keyword in URL',
            'status'  => $pass ? 'pass' : 'fail',
            'message' => $pass
                ? 'Focus keyword found in the URL.'
                : 'Focus keyword not found in the URL.',
        ];
    }

    private function checkKeywordInIntroduction(): array
    {
        $pass = str_contains(strtolower($this->introduction), $this->keyword);
        return [
            'label'   => 'Focus Keyword in Introduction',
            'status'  => $pass ? 'pass' : 'fail',
            'message' => $pass
                ? 'Focus keyword appears in the first paragraph. Well done!'
                : 'Add the focus keyword to your first paragraph.',
        ];
    }

    private function checkKeywordInSubheadings(): array
    {
        if (empty($this->headings)) {
            return [
                'label'   => 'Focus Keyword in Subheadings',
                'status'  => 'warn',
                'message' => 'No H2/H3 subheadings found in your content.',
            ];
        }

        $matched = collect($this->headings)
            ->filter(fn($h) => str_contains(strtolower($h), $this->keyword))
            ->count();

        $ratio = $matched / count($this->headings);
        $pass  = $ratio >= 0.30;

        return [
            'label'   => 'Focus Keyword in Subheadings',
            'status'  => $pass ? 'pass' : 'fail',
            'message' => $pass
                ? 'Good use of focus keyword in subheadings.'
                : 'Less than 30% of your H2/H3 subheadings contain the focus keyword.',
        ];
    }

    private function checkKeywordInImageAlts(): array
    {
        if (empty($this->imageAlts)) {
            return [
                'label'   => 'Focus Keyword in Image Alt Attributes',
                'status'  => 'warn',
                'message' => 'No images found in your content.',
            ];
        }

        $found = collect($this->imageAlts)
            ->contains(fn($alt) => str_contains(strtolower($alt), $this->keyword));

        return [
            'label'   => 'Focus Keyword in Image Alt Attributes',
            'status'  => $found ? 'pass' : 'fail',
            'message' => $found
                ? 'Focus keyword found in image alt attribute.'
                : 'Add the focus keyword to at least one image alt attribute.',
        ];
    }

    private function checkKeywordDensity(): array
    {
        $plainText = strtolower(strip_tags($this->content));
        $wordCount = str_word_count($plainText);
        $keyCount  = substr_count($plainText, $this->keyword);
        $density   = $wordCount > 0 ? ($keyCount / $wordCount) * 100 : 0;
        $pass      = $density >= 0.5 && $density <= 2.5;

        return [
            'label'   => 'Focus Keyword Density',
            'status'  => $pass ? 'pass' : ($density > 2.5 ? 'fail' : 'warn'),
            'message' => $pass
                ? 'Keyword density is ' . round($density, 1) . '%. Great!'
                : ($density > 2.5
                    ? 'Density too high at ' . round($density, 1) . '% (' . $keyCount . ' times). Keep it below 2.5%.'
                    : 'Density too low at ' . round($density, 1) . '%. Aim for 0.5% to 2.5%.'),
            'extra'   => ['density' => round($density, 1), 'count' => $keyCount],
        ];
    }

    private function extractIntroduction(string $content): string
    {
        preg_match('/<p[^>]*>(.*?)<\/p>/is', $content, $matches);
        return strip_tags($matches[1] ?? '');
    }

    private function extractHeadings(string $content): array
    {
        preg_match_all('/<h[23][^>]*>(.*?)<\/h[23]>/is', $content, $matches);
        return array_map('strip_tags', $matches[1] ?? []);
    }

    private function extractImageAlts(string $content): array
    {
        preg_match_all('/<img[^>]+alt=["\']([^"\']*)["\'][^>]*>/is', $content, $matches);
        return $matches[1] ?? [];
    }
}