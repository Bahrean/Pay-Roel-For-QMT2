<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;
use App\Models\SendToExpert;
use Carbon\Carbon;

class SendToExpertController extends Controller
{
    //

    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function create()
    {
        return view('laravel_firebase.send_to_expert.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            
        ]);

        // Save to local database
        $marketPrice = SendToExpert::create($validatedData);

        // Save to Firebase
        $this->saveToFirebase($marketPrice);

        return redirect()->route('send_to_expert.create')
                        ->with('success', 'Information saved successfully!');
    }

    protected function saveToFirebase(SendToExpert $marketPrice)
    {
        $database = $this->firebase->getDatabase();
        
        $newPost = $database
            ->getReference('send_to_expert')
            ->push([
                'title' => $marketPrice->title,
                'description' => $marketPrice->description,
                'status' => $marketPrice->status,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
    }

    public function index()
    {
        $database = $this->firebase->getDatabase();
        $marketPrices = $database->getReference('send_to_expert')->getValue();

        return view('laravel_firebase.send_to_expert.index', compact('marketPrices'));
    }

    public function edit($firebaseKey)
    {
        try {
            $database = $this->firebase->getDatabase();
            $priceData = $database->getReference('send_to_expert/'.$firebaseKey)->getValue();
            
            if (!$priceData) {
                throw new \Exception('Price not found in Firebase');
            }
            
            return view('laravel_firebase.send_to_expert.edit', [
                'firebaseKey' => $firebaseKey,
                'priceData' => $priceData
            ]);
        } catch (\Exception $e) {
            return redirect()->route('send_to_expert.index')
                ->with('error', 'Error: '.$e->getMessage());
        }
    }
    
    public function update(Request $request, $firebaseKey)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'status' => 'required|date',
        ]);
        
        try {
            $database = $this->firebase->getDatabase();
            $database->getReference('send_to_expert/'.$firebaseKey)->update([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'],
                'status' => $validatedData['status'],
                'updated_at' => now()->toDateTimeString(),
            ]);
        
            return redirect()->route('send_to_expert.index')
                ->with('success', 'Information updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating price: '.$e->getMessage());
        }
    }
    
    public function destroy($firebaseKey)
    {
        try {
            $database = $this->firebase->getDatabase();
            $database->getReference('send_to_expert/'.$firebaseKey)->remove();
            
            return redirect()->route('send_to_expert.index')
                ->with('success', 'Information deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting price: '.$e->getMessage());
        }
    }
}
