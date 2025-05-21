<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Services\FirebaseService;
use App\Models\AgricultureExpert;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;

class FirebaseController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function showForm()
    {
        return view('laravel_firebase.agriculture_expert.form');
    }

    public function submitForm(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:users|max:200',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required',
            'gender' => 'nullable',
            'proffesion' => 'nullable',
            
        
        
        ]);

        // Create user with photo path
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'gender' => $request->gender,
            'proffesion' => $request->proffesion,
            
        
        ]);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string',
            'password' => 'required|string',
            'gender' => 'required|string',
            'proffesion' => 'required|string',
        
            
        ]);

        // Save to local database
        $message = AgricultureExpert::create($validatedData);

        // Save to Firebase
        $this->saveToFirebase($message);

        return redirect()->route('agriexpert.index')
                        ->with('success', 'New Agriculture Exper Create successfully!');
    }



    protected function saveToFirebase(AgricultureExpert $message)
    {
        $database = $this->firebase->getDatabase();
        
        $newPost = $database
            ->getReference('messages')
            ->push([
                'name' => $message->name,
                'email' => $message->email,
                'password' => $message->password,
                'gender' => $message->gender,
                'proffesion' => $message->proffesion,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
    }

    public function index()
    {
        $database = $this->firebase->getDatabase();
        $agriexpert = $database->getReference('messages')->getValue();

        return view('laravel_firebase.agriculture_expert.index', compact('agriexpert'));
    }


    public function edit($firebaseKey)
    {
        try {
            $database = $this->firebase->getDatabase();
            $priceData = $database->getReference('messages/'.$firebaseKey)->getValue();
            
            if (!$priceData) {
                throw new \Exception('Price not found in Firebase');
            }
            
            return view('laravel_firebase.agriculture_expert.edit', [
                'firebaseKey' => $firebaseKey,
                'priceData' => $priceData
            ]);
        } catch (\Exception $e) {
            return redirect()->route('agriexpert.index')
                ->with('error', 'Error: '.$e->getMessage());
        }
    }
    
    public function update(Request $request, $firebaseKey)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'proffesion' => 'required|string|max:255',
        
        
        ]);
    
        try {
            $database = $this->firebase->getDatabase();
            $database->getReference('messages/'.$firebaseKey)->update([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => $validatedData['password'],
                'proffesion' => $validatedData['proffesion'],
            
                'updated_at' => now()->toDateTimeString(),
            ]);
    
            return redirect()->route('agriexpert.index')
                ->with('success', 'agriexpert updated successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error updating price: '.$e->getMessage());
        }
    }
    
    public function destroy($firebaseKey)
    {
        try {
            $database = $this->firebase->getDatabase();
            $database->getReference('messages/'.$firebaseKey)->remove();
    
            return redirect()->route('agriexpert.index')
                ->with('success', 'agriexpert deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting price: '.$e->getMessage());
        }
    }

}
