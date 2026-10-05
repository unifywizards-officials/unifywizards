<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Schema;
use App\Models\SchemaPageMap;

class SchemaController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:schema');
    }

    public function index()
    {
         $schemas = Schema::with('pages')->latest()->paginate(15);
        return view('admin.schemas.index', compact('schemas'));
    }

    public function create()
    {
        return view('admin.schemas.create');
    }

    public function store(Request $request)
    {
        
       
        $finalJson = [];

        if($request->schema_types){
            foreach($request->schema_types as $type){

                if(!empty($request->json_data[$type])){

                    $decoded = json_decode($request->json_data[$type], true);

                    if(json_last_error() !== JSON_ERROR_NONE){
                        return back()->with('error', $type.' JSON invalid');
                    }

                    $finalJson[$type] = $decoded;
                }
            }
        }
        $mainPage = $request->pages[0] ?? null;
        $schema = Schema::create([
            'type' => 'multiple',
            'page' =>  $mainPage,
            'json_data' => json_encode($finalJson),
            'status' => 1
        ]);

        // pages
        if($request->pages){
            foreach($request->pages as $page){
                SchemaPageMap::create([
                    'schema_id' => $schema->id,
                    'page' => $page
                ]);
            }
        }

        return redirect()->route('admin.schemas.index')->with('success','Schema Created');
    }

    public function edit($id)
    {
        $schema = Schema::with('pages')->findOrFail($id);

        $json = json_decode($schema->json_data, true);

        return view('admin.schemas.edit', compact('schema','json'));
    }

    public function update(Request $request, $id)
    {
        $schema = Schema::findOrFail($id);

        $finalJson = [];

        if($request->schema_types){
            foreach($request->schema_types as $type){

                if(!empty($request->json_data[$type])){

                    $decoded = json_decode($request->json_data[$type], true);

                    if(json_last_error() !== JSON_ERROR_NONE){
                        return back()->with('error', $type.' JSON invalid');
                    }

                    $finalJson[$type] = $decoded;
                }
            }
        }
        $mainPage = $request->pages[0] ?? null;
        $schema->update([
            'json_data' => json_encode($finalJson),
            'page' =>$mainPage,
            'status' => $request->status ?? 1
        ]);

        // update pages
        SchemaPageMap::where('schema_id',$schema->id)->delete();

        if($request->pages){
            foreach($request->pages as $page){
                SchemaPageMap::create([
                    'schema_id' => $schema->id,
                    'page' => $page
                ]);
            }
        }

        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Schema::destroy($id);
        return back()->with('success','Deleted');
    }
}