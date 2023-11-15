<?php

namespace App\Helpers;

class Helper
{
    public static function category($categories)
    {
        $html = '';
        foreach ($categories as $key => $category) {
            $html .= '
                <tr id="' . $category->id . '" name="item">
                    <td>
                        <input type="checkbox" id="item_checkbox" name="item_checkbox" data-id="' . $category->id . '">
                    </td>
                    <td>' . $key + 1 . '.</td>
                    <td>' . $category->name . '</td>
                    <td>' . $category->description . '</td>
                    <td class="text-center">' . self::active($category->active) . '</td>
                    <td class="text-center">
                        <a class="btn btn-info btn-sm" href="/admin/categories/edit/' . $category->id . '">
                            <i class="fas fa-pencil-alt"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                            onClick="removeRow(' . $category->id . ', \'/admin/categories/destroy\', \'categories-table\')">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            ';
        }
        return $html;
    }

    public static function active($active): string
    {
        return $active == 1 ? '<span class="badge badge-pill badge-success">Hiển thị</span>'
            : '<span class="badge badge-pill badge-secondary">Ẩn</span>';
    }

    public static function makeAvatar($fontPath, $dest, $char) {
        $path = $dest;
        $image = imagecreate(200,200);
        $red = rand(0,255);
        $green = rand(0,255);
        $blue = rand(0,255);
        imagecolorallocate($image, $red, $green, $blue);
        $textcolor = imagecolorallocate($image,255,255,255);
        imagettftext($image,100,0,55,150,$textcolor,$fontPath,$char);
        imagepng($image, $path);
        imagedestroy($image);
        return '/' . $path;
    }
}
