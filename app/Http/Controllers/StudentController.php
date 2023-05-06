<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

Class StudentController extends Controller {
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getUsers()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    public function add(Request $request){ //ADD USER
        
        $rules = [
            'lastname' => 'required | max:50 | alpha_num',
            'firstname'=> 'required | max:50 | alpha_num',
            'middlename' => 'required | max:50 | alpha_num',
            'age' => 'required | lte:50'

        ];

        $this->validate($request,$rules);

        $user = User::create($request->all());
        return response()->json($user, 200);
    }
    
    public function updateUser(Request $request, $id) { //UPDATE USER
        $rules = [
          'lastname' => 'required | max:50 | alpha_num',
          'firstname'=> 'required | max:50 | alpha_num',
          'middlename' => 'required | max:50 | alpha_num',
          'age' => 'required | lt:50'
        ];
    
        $this->validate($request, $rules);
    
        $user = User::findOrFail($id);
    
        $user->fill($request->all());
    
        if ($user->isClean()) {
            return response()->json("At least one value must
            change", 403);
        } else {
            $user->save();
            return response()->json($user, 200);
        }
    }


    public function deleteUser($id) {
        
        $users = User::where('id', $id)->delete();
        
        if ($users){
            return response()->json($users);
        }
        {
            return $this -> errorResponse('user does not exits', Reponse::HTTP_NOT_FOUND);
        }
    }

    public function showUser($id) {
        
        $users = User::where('id', $id)->first();
        
        if ($users){
            return response()->json($users);}
        {
            return $this -> errorResponse('user does not exits', Reponse::HTTP_NOT_FOUND);
        }
    }

}
