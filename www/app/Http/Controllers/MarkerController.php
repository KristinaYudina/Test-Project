<?php namespace App\Http\Controllers;

use App\Models\Marker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MarkerController extends Controller
{
    /**
     * Created marker.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validatedData = Validator::make($request->all(), [
            'name' => 'required|min:3|max:255',
            "latitude" => 'required',
            "longitude" => 'required',
            'count_population' => 'required|integer',
        ]);

        if ($validatedData->fails()) {
            return \Response::json(['errors' => $validatedData->errors()]);
        } else {
            $data = [
                "name" => $request->get("name"),
                "latitude" => $request->get("latitude"),
                "longitude" => $request->get("longitude"),
                "count_population" => $request->get("count_population")
            ];
            $marker = new Marker($data);
            $marker->save();
            return \Response::json(['status' => 'success', 'content' => 'Ваши данные успешно отправлены.']);
        }
    }
}
