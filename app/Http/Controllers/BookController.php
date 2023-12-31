<?php    
namespace App\Http\Controllers;
    
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class BookController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:book-create', ['only' => ['create','store']]);
         $this->middleware('permission:book-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:book-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $books = Book::latest()->paginate(5);
        return view('books.index',compact('books'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('books.create');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        request()->validate([
            'bookTypeID' => 'required',
            'bookName' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'stock' => 'required',
        ]);
    
        Book::create($request->all());
    
        return redirect()->route('books.index')
                        ->with('success','Book created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book): View
    {
        return view('books.show',compact('book'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book): View
    {
        return view('books.edit',compact('book'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book): RedirectResponse
    {
         request()->validate([
            'bookTypeID' => 'required',
            'bookName' => 'required',
            'description' => 'required',
            'publisher' => 'required',
            'year' => 'required',
            'stock' => 'required',
        ]);
    
        $book->update($request->all());
    
        return redirect()->route('books.index')
                        ->with('success','Book updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();
    
        return redirect()->route('books.index')
                        ->with('success','Book deleted successfully');
    }
}