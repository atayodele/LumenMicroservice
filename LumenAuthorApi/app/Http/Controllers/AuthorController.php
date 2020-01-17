<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Author;

class AuthorController extends Controller
{

    use ApiResponser;
    
    public function __construct()
    {
        //
    }

    //Return list of Authors
    public function index()
    {
        $authors =  Author::all();
        return $this->successResponse($authors);
    }

    //create Authors
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255'
        ];
        $this->validate($request, $rules);
        $author = Author::create($request->all());
        return $this->createResponse($author);
    }

    //obtain and show Authors
    public function show($author)
    {
        $authors =  Author::findOrFail($author);
        return $this->successResponse($authors);
    }

    //Update Authors
    public function update(Request $request, $author)
    {
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255'
        ];
        $this->validate($request, $rules);
        $authors =  Author::findOrFail($author);
        $authors->fill($request->all());
        if($authors->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $authors->save();

        return $this->successResponse($authors);
    }

    //Delete Authors
    public function destroy($author)
    {
        $authors =  Author::findOrFail($author);

        $authors->delete();

        return $this->noResponse('Author Deleted Successfully!');
    }
}
