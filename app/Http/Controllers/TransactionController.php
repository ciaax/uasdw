<?php    
namespace App\Http\Controllers;
    
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
    
class TransactionController extends Controller
{ 
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:transaction-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:transaction-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $transactions = Transaction::latest()->paginate(5);
        return view('transactions.index',compact('transactions'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        return view('transactions.create');
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
            'transID' => 'required',
            'bookID' => 'required',
            'qty' => 'required',
            'returnDate' => 'required',
            'fineDays' => 'required',
            'fine' => 'required',
        ]);
    
        Transaction::create($request->all());
    
        return redirect()->route('transactions.index')
                        ->with('success','Transaction created successfully.');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction): View
    {
        return view('transactions.show',compact('transaction'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction): View
    {
        return view('transactions.edit',compact('transaction'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
         request()->validate([
            'transID' => 'required',
            'bookID' => 'required',
            'qty' => 'required',
            'returnDate' => 'required',
            'fineDays' => 'required',
            'fine' => 'required',
        ]);
    
        $transaction->update($request->all());
    
        return redirect()->route('transactions.index')
                        ->with('success','Transaction updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();
    
        return redirect()->route('transactions.index')
                        ->with('success','Transaction deleted successfully');
    }
}