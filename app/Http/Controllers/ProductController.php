<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use App\Product;
use App\Organisation;
use App\Usersorganization;
use Auth;
use Log;  
class ProductController extends Controller
{

    public function index($org_slug)
    {
        $products = Product::all();
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $getting_roll_id = '3';
        Log::info('org_id main  kiya aa rha hai');
        $org_user = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
        return view('user-wizard.wizard-dashboard',compact('products','org_user','org_slug','getting_roll_id'));
    }
  
 
    public function createStepOne(Request $request,$org_slug)
    {
        $product = $request->session()->get('product');
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $getting_roll_id = '3';
        Log::info('org_id main  kiya aa rha hai value  ' .$org);
        $org_user = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
        return view('user-wizard.create-step-one',compact('product','org_user','org_slug','getting_roll_id'));
    }
  
 
    public function postCreateStepOne(Request $request,$org_slug)
    {
        Log::info('postCreateStepOne is me aa gaye hai');
        // $validate_url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $validatedData = $request->validate([
            'projectname' => 'required',
            'facebook' => 'required',
            'linkedIn' => 'required',
            'twitter' => 'required',
            'instagram' => 'required',
            'youtube' => 'required',
            // 'facebook' => 'required|regex:'.$validate_url,
            // 'linkedIn' => 'required|regex:'.$validate_url,
            // 'twitter' => 'required|regex:'.$validate_url,
            // 'instagram' => 'required|regex:'.$validate_url,
            // 'youtube' => 'required|regex:'.$validate_url,
        ]);
  
        if(empty($request->session()->get('product'))){
            $product = new Product();
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }else{
            $product = $request->session()->get('product');
            $product->fill($validatedData);
            $request->session()->put('product', $product);
        }
        Log::info('postCreateStepOne data store ho rha hai' .$request);
        return redirect()->route('products.create.step.two',['org_slug' =>$org_slug]);
    }
  
 
    public function createStepTwo(Request $request,$org_slug)
    {
        Log::info('createStepTwo now we are in this function');
        $product = $request->session()->get('product');
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $getting_roll_id = '3';
        Log::info('org_id main  kiya aa rha hai');
        $org_user = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
        return view('user-wizard.create-step-two',compact('product','org_user','org_slug','getting_roll_id'));
    }
  
 
    public function postCreateStepTwo(Request $request,$org_slug)
    {
        $validate_url = '/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
        $validatedData = $request->validate([
            'pinterest' => 'required|regex:'.$validate_url,
            'reddit' => 'required|regex:'.$validate_url,
            'tumblr' => 'required|regex:'.$validate_url,
            'plurk' => 'required|regex:'.$validate_url,
            'getpocket' => 'required|regex:'.$validate_url,
        ]);
  
        $product = $request->session()->get('product');
        $product->fill($validatedData);
        $request->session()->put('product', $product);
  
        return redirect()->route('products.create.step.three',['org_slug' =>$org_slug]);
    }
  

    public function createStepThree(Request $request,$org_slug)
    {
        $product = $request->session()->get('product');
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $getting_roll_id = '3';
        Log::info('org_id main  kiya aa rha hai');
        $org_user = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
        return view('user-wizard.create-step-three',compact('product','org_user','org_slug','getting_roll_id'));
    }
 
    public function postCreateStepThree(Request $request,$org_slug)
    {
        Log::info('finish ke baad value aaa raha hai kiya');
        $product = $request->session()->get('product');
        $product->save();
  
        $request->session()->forget('product');
  
        return redirect()->route('products.index',['org_slug' =>$org_slug]);
    }

    public function viewWizard($id){
        Log::info('wizardview calling');
        $wizard_view = Product::find($id);
        $org = Organisation::where('org_slug',$org_slug)->first();
        $user_id = Auth::user()->id;
        $org_id = $org['id'];
        $getting_roll_id = '3';
        Log::info('org_id main  kiya aa rha hai');
        $org_user = Usersorganization::where('u_org_user_id',$user_id)->where('u_org_organization_id',$org_id)->first();
        return redirect()->route('showWizard',['org_slug' =>$org_slug]);
    }

  
}