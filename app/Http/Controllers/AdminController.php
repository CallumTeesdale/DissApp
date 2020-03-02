<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Market;
use App\Category;


class AdminController extends Controller
{
    //
    public function index()
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        return view('admin-view');
    }

    public function getMarketItemAll()
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        $items = Market::paginate(6);
        $storage = 'market';
        return view('admin-view', ['items' => $items, 'storage' => $storage]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function editMarketItem($id)
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        $item = Market::where('id', $id)->get()->first();
        return view('market-item-form', ['item' => $item]);
    }
    public function createMarketItem()
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        return view('market-item-form');
    }

    public function postMarketItem(Request $request)
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        try {
            if (!empty($request->id)) {
                $market  = Market::where('id', request()->id)->get()->first();
                if ($request->hasFile('image')) {
                    $imageName = request()->id . '.' . request()->image->getClientOriginalExtension();
                    $request->image->storeAs('market', $imageName);
                    $market->image = $imageName;
                }

                $market->name = $request->name;
                $market->description = $request->description;
                $market->price = $request->price;
                $market->barcode = $request->barcode;
                $market->live = $request->live;
                $market->save();
            } else {
                $survey = Market::create([
                    'image' => 'item.jpg',
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'barcode' => $request->barcode,
                    'live' => $request->live,
                ]);
            }
            $variables = Market::all();
            return view('admin-view', ['variables' => $variables]);
        }
        //@codeCoverageIgnoreStart
        catch (\Exception $e) {
            $message = $e->getMessage();
            return view('generic-message-view', ['message' => $message]);
        }
        //@codeCoverageIgnoreStop

    }

    public function getCategoriesAll()
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        $categories = Category::paginate(6);
        $storage = 'categories';
        return view('admin-view', ['categories' => $categories, 'storage' => $storage]);
    }
    public function editCategory()
    {
        # code...
    }
}