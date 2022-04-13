<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Parrain;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Class HomeController.
 */
class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('frontend.index');
    }

    public function parrainer(Request $request) : RedirectResponse
    {
        $this->validate($request, [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'nin' => ['required', 'string'],
            'nce' => ['required', 'string'],
            'taille' => ['required', 'integer'],
            'phone' => ['required', 'integer'],
        ]);

        Parrain::create($request->all());

        // session()->flash('flash_success', "Merci d'avoir parrainer pour la coalition BENNO BOKK YAKKAR de Saint Louis");
        return redirect()->route('frontend.index')->with('flash_success', "Merci d'avoir parrainer pour la coalition BENNO BOKK YAKKAR de Saint Louis");
    }
}
