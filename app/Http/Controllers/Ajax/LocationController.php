<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface;
use App\Repositories\Interfaces\ProvinceRepositoryInterface;

class LocationController extends Controller
{
    protected $districtRepository;
    protected $provinceRepository;

    public function __construct(
        DistrictRepositoryInterface $districtRepository,
        ProvinceRepositoryInterface $provinceRepository
    ) {
        $this->districtRepository = $districtRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function getLocation(Request $request)
    {
        $get = $request->input();

        $html = '';

        if ($get['target'] == 'districts') {

            $provinces = $this->provinceRepository->findById($get['data']['location_id'], ['code', 'name'], ['districts']);
            $html = $this->renderHTML($provinces->districts);

        } else if ($get['target'] == 'wards') {
            $districts = $this->districtRepository->findById($get['data']['location_id'], ['code', 'name'], ['wards']);
            $html = $this->renderHTML($districts->wards, 'Chọn Phường / Xã');
        }

        return response()->json([
            'html' => $html
        ]);
    }

    public function renderHTML($districts, $root = 'Chọn Quận / Huyện')
    {
        $html = '<option value="">' . $root . '</option>';

        foreach ($districts as $district) {
            $html .= '<option value="' . $district->code . '">' . $district->name . '</option>';
        }

        return $html;
    }
}
