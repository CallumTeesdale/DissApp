<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Market;
use App\Category;
use App\Barcode;
use Exception;

/**
 * Class AdminController
 * @package App\Http\Controllers
 */
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
        return view('admin.admin-view');
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
        $countBar = [];
        $items = Market::all();
        foreach ($items as $item) {
            $barcodes = Barcode::where('market_id', $item->id)->get();
            if (!empty($barcodes)) {

                $countBar[$item->id] = count($barcodes);
            }
        }
        $storage = 'market';
        return view('admin.admin-view', ['items' => $items->paginate(6), 'storage' => $storage, 'barcodes' => $countBar]);
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
        return view('admin.market-item-form', ['item' => $item]);
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
        return view('admin.market-item-form');
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
                if ($request->hasFile('barcodes')) {
                    $file = fopen(request()->barcodes->getRealPath(), "r");
                    while (($data = fgetcsv($file)) !== FALSE) {
                        $barcode = Barcode::create([
                            'market_id' => request()->id,
                            'barcode' => $data[0]
                        ]);
                    }
                }
                /**
                 * * Save the edited info
                 */
                $market->name = $request->name;
                $market->description = $request->description;
                $market->price = $request->price;
                $market->live = $request->live;
                $market->save();
            }
            /**
             * * Create a new item
             */
            else {
                $survey = Market::create([
                    'image' => 'item.jpg',
                    'name' => $request->name,
                    'description' => $request->description,
                    'price' => $request->price,
                    'live' => $request->live,
                ]);

                /**
                 * * Get the inserted id
                 */

                $market  = Market::where('id', $survey->id)->get()->first();

                if ($request->hasFile('image')) {
                    $imageName = $survey->id . '.' . request()->image->getClientOriginalExtension();
                    $request->image->storeAs('market', $imageName);
                    $market->image = $imageName;
                    $market->save();
                }
                if ($request->hasFile('barcodes')) {
                    $file = fopen(request()->barcodes->getRealPath(), "r");
                    while (($data = fgetcsv($file)) !== FALSE) {
                        $barcode = Barcode::create([
                            'market_id' => $survey->id,
                            'barcode' => $data[0]
                        ]);
                    }
                }
                return $this->getMarketItemAll();
            }
        }
        //@codeCoverageIgnoreStart
        catch (\Exception $e) {
            $message = $e->getMessage();
            return view('generic-message-view', ['message' => $message]);
        }
        //@codeCoverageIgnoreStop
        $variables = Market::all();
        return view('admin.admin-view', ['variables' => $variables]);
    }
    /**
     * * Delete the market item
     */
    public function deleteItem($id)
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        $item = Market::where('id', $id)->get()->first();
        $barcodes = Barcode::where('market_id', $id)->get();
        $dItem = $item->delete();
        foreach ($barcodes as $bar) {
            $bar->delete();
        }
        return $this->getMarketItemAll();
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
        return view('admin.admin-view', ['categories' => $categories, 'storage' => $storage]);
    }

    /**
     * * Display the category creation form
     */
    public function editCategory($id)
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        $category = Category::where('id', $id)->get()->first();
        return view('admin.category-form', ['category' => $category]);
    }

    /**
     * * Save the category
     */

    public function postCategory(Request $request)
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
                $category  = Category::where('id', request()->id)->get()->first();

                /**
                 * * If a new image was uploaded save the new image
                 */
                if ($request->hasFile('image')) {
                    $imageName = request()->id . '.' . request()->image->getClientOriginalExtension();
                    $request->image->storeAs('categories', $imageName);
                }
                $category->name = $request->name;
                $category->save();
            }
            /**
             * * Create a new item
             */
            else {
                $cat = $category = Category::create([
                    'name' => $request->name,
                ]);

                if ($request->hasFile('image')) {
                    $imageName = $cat->id . '.' . request()->image->getClientOriginalExtension();
                    $request->image->storeAs('categories', $imageName);
                }
            }
        } catch (Exception $e) {
            $message = $e->getMessage();
            return view('generic-message-view', ['message' => $message]);
        }
        return $this->getCategoriesAll();
    }

    /**
     * * Delete the category
     */

    public function deleteCategory($id)
    {
        if (Auth::user()->priv_level !== 1) {
            $message = 'You are not authorised';
            return view('generic-message-view', ['message' => $message]);
        }
        $category = Category::where('id', $id)->get()->first();
        $dCategory = $category->delete();
        return $this->getCategoriesAll();
    }
}
