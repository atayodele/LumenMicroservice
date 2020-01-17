<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use App\Book;

class BookController extends Controller
{
    use ApiResponser;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        $books =  Book::all();
        return $this->successResponse($books);
    }

    //create Authors
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:255',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1'
        ];
        $this->validate($request, $rules);
        $books = Book::create($request->all());
        return $this->createResponse($books);
    }

    //obtain and show Authors
    public function show($book)
    {
        $books =  Book::findOrFail($book);
        return $this->successResponse($books);
    }

    //Update Authors
    public function update(Request $request, $book)
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:255',
            'price' => 'min:1',
            'author_id' => 'min:1'
        ];
        $this->validate($request, $rules);
        $books =  Book::findOrFail($book);
        $books->fill($request->all());
        if($books->isClean()){
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $books->save();

        return $this->successResponse($books);
    }

    //Delete Authors
    public function destroy($book)
    {
        $books =  Book::findOrFail($book);

        $books->delete();

        return $this->noResponse('Book Deleted Successfully!');
    }
}
