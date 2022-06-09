<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\HomeSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class HomeSliderController extends Controller
{
    public function homeSlider()
    {
        // $homeSlide = HomeSlide::find(1);
        $homeSlide = HomeSlide::all()->first();

        return view('admin.home_slide.home_slide_all', ['homeSlide' => $homeSlide]);
    }

    public function updateSlider(Request $request, $slide_id)
    {
        // get the user id and get other details needed
        $slide_info = HomeSlide::findOrFail($slide_id);

        if ($request->hasFile('home_image')) { // check if file exists in input field

            if ($slide_info->home_image) { // check if file name exist in database
                // if file exist in data and in folder, delete and update new file
                File::delete(public_path('upload/home_slide/' . $slide_info->home_image));
                $image = $request->file('home_image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                
                // used to resized the image
                Image::make($image)->resize(636, 852)->save('upload/home_slide/' . $name_gen);
                $save_url = $name_gen;

                HomeSlide::findOrFail($slide_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'video_url' => $request->video_url,
                    'home_image' => $save_url,
                ]);

                $notification = array(
                    'message' => 'Home Slide Updated with Image Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            } else {
                // if file does not exist create file
                $image = $request->file('home_image');
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

                Image::make($image)->resize(636, 852)->save('upload/home_slide/' . $name_gen);
                $save_url = $name_gen;

                HomeSlide::findOrFail($slide_id)->update([
                    'title' => $request->title,
                    'short_title' => $request->short_title,
                    'video_url' => $request->video_url,
                    'home_image' => $save_url,
                ]);

                $notification = array(
                    'message' => 'Home Slide Updated with Image Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->back()->with($notification);
            }
        } else {
            // updating without image
            HomeSlide::findOrFail($slide_id)->update([
                'title' => $request->title,
                'short_title' => $request->short_title,
                'video_url' => $request->video_url,
            ]);

            $notification = array(
                'message' => 'Home Slide Updated without Image Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }
}
