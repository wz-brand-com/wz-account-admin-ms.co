<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class AccountAdminApiController extends Controller
{
    public function index()
    {
        // Get all the Users from db
        $Users = User::all()->get();

        $response = [
            'success' => true,
            'data' => UserResource::collection($Users),
            'message' => 'Users retrieved successfully.',
            'count' => count($Users)];

        return response()->json($response, 200);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors(),
            ];
            return response()->json($response, 422);
        } else {
            Log::info('Account Admin stored successfully');
            $Users = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => bcrypt($input['password']),

            ]);
            $response = [
                'success' => true,
                //'data' => $data,
                'data' => new UserResource($Users),
                'message' => 'Account Admin stored successfully.',
            ];
            return response()->json($response, 200);
        }
    }
####################      edit page calling #####################################3
    public function edit($id)
    {
        $Users = User::find($id);
        if (is_null($Users)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Account Admin not found.',
            ];
            return response()->json($response, 404);
        } else {
            $response = [
                'success' => true,
                'data' => new UserResource($Users),
                'message' => 'Account Admin Edit successfully.',
            ];
            return response()->json($response, 200);
        }
    }

    ####################  edit page end #######################################

    public function update(Request $request)
    {
        log::info("update ka value aa gaya hai");
        $rules = array(
            'name' => 'required',
            'email' => 'required',
        );
        $error = Validator::make($request->all(), $rules);
        if ($error->fails()) {
            $response = [
                'success' => false,
                'data' => 'Validation Error.',
                'message' => $validator->errors(),
            ];
            return response()->json($response, 422);
        }
        $form_data = array(
            'name' => $request->name,
            'email' => $request->email,
        );
        User::whereId($request->hidden_id)->update($form_data);
        $response = [
            'success' => true,

            'message' => 'Account Admin update successfully.',
        ];
        return response()->json($response, 200);
    }

    public function destroy($id)
    {
        $Users = User::find($id);

        if (is_null($Users)) {
            $response = [
                'success' => false,
                'data' => 'Empty',
                'message' => 'Account Admin not found.',
            ];

            return response()->json($response, 404);
        } else {
            $Users->delete();
            $response = [
                'success' => true,
                'data' => new UserResource($Users),
                'message' => 'Account Admin deleted successfully.',
            ];

            return response()->json($response, 200);
        }
    }
}
