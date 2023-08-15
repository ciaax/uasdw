<?php    
namespace App\Http\Controllers;
    
use App\Models\BookType;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class BookTypeController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:bookType-create', ['only' => ['create','store']]);
         $this->middleware('permission:bookType-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bookType-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $bookTypes = BookType::latest()->paginate(5);
        return view('bookTypes.index',compact('bookTypes'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('bookTypes.create');
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
            'bookType' => 'required',
        ]);
    
        BookType::create($request->all());
    
        return redirect()->route('bookTypes.index')
                        ->with('success','Book Category created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function show(BookType $bookType): View
    {
        return view('bookTypes.show',compact('bookType'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function edit(BookType $bookType): View
    {
        return view('bookTypes.edit',compact('bookType'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BookType $bookType): RedirectResponse
    {
         request()->validate([
            'bookTypeID' => 'required',
            'bookType' => 'required',
        ]);
    
        $bookType->update($request->all());
    
        return redirect()->route('bookTypes.index')
                        ->with('success','Book Category updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BookType  $bookType
     * @return \Illuminate\Http\Response
     */
    public function destroy(BookType $bookType): RedirectResponse
    {
        $bookType->delete();
    
        return redirect()->route('bookTypes.index')
                        ->with('success','Book Category deleted successfully');
    }
}