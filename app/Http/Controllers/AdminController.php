<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Market;
use App\Category;


class AdminController extends Controller
{
    /**
     * * Display the admin panel
     */
    public function index()
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        return view('admin-view');
    }


    /**
     * * Get all the market items
     */
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

    /**
     * * Display the market item creation form
     */
    public function createMarketItem()
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        return view('market-item-form');
    }

    /**
     * * Save the Created or edited market item
     */

    public function postMarketItem(Request $request)
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }

        try {

            /**
             * * If an id was posted then edit the existing item by the posted id
             */
            if (!empty($request->id)) {
                $market  = Market::where('id', request()->id)->get()->first();

                /**
                 * * If a new image was uploaded save the new image
                 */
                if ($request->hasFile('image')) {
                    $imageName = request()->id . '.' . request()->image->getClientOriginalExtension();
                    $request->image->storeAs('market', $imageName);
                    $market->image = $imageName;
                }

                /**
                 * * Save the edited info
                 */
                $market->name = $request->name;
                $market->description = $request->description;
                $market->price = $request->price;
                $market->barcode = $request->barcode;
                $market->live = $request->live;
                $market->save();

                /**
                 * * Create a new item
                 */
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

    /**
     * * Get all categories
     */
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