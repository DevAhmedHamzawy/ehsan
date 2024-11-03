<?php

namespace App\Http\Controllers\Admin;

use App\Setting;
use App\Upload\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $settings
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view('admin.settings.edit', ['settings' => $setting]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $settings
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Setting $setting)
    {
        $validator = Validator::make($request->all(), ['name' => 'required', 'about' => 'required', 'telephone' => 'required', 'email' => 'required']);
        if($request->hasFile('icon_qr_image'))
        {
            $request->merge(['qr_code' => Upload::uploadImage($request->icon_qr_image, 'settings' , 'qr_code')]);
        }
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->with(['message' => 'من فضلك قم بمراجعة تلك الأخطاء', 'alert' => 'alert-danger']);
        }
        $setting->update($request->except(['icon_qr_image']));
        return redirect()->route('settings.edit',$setting->id)->with(['message' => 'تم التعديل بنجاح', 'alert' => 'alert-success']);
    }
}
