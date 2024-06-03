<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface;

class LocationController extends Controller
{
    protected $districtRepository;

    public function __construct(
        DistrictRepositoryInterface $districtRepository
    ) {
        $this->districtRepository = $districtRepository;
    }

    public function getLocation(Request $request)
    {
        $province_id = $request->province_id;
        $districts = $this->districtRepository->findByProvinceId($province_id);

        return response()->json([
            'html' => $this->renderHTML($districts)
        ]);
    }

    public function renderHTML($districts)
    {
        $html = '<option value="">Chọn Quận / Huyện</option>';

        foreach ($districts as $district) {
            $html .= '<option value="' . $district->district_code . '">' . $district->name . '</option>';
        }

        return $html;
    }
}