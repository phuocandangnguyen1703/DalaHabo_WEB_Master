<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\Place\PlaceService;
use App\Http\Services\Tourguide\TourguideService;
use Illuminate\Support\Facades\Auth;
class MainController extends Controller
{
    protected $placeService, $tourguideService;

    public function __construct(PlaceService $placeService, TourguideService $tourguideService)
    {
        $this->placeService = $placeService;
        $this->tourguideService = $tourguideService;
    }

    public function index()
    {
        return view('admin.dashboard', [
            'title' => 'Tổng quan',
            'menu' => 'Tổng quan',
            'places' => $this->placeService->count(),
            'tourguides' => $this->tourguideService->count(),
        ]);
    }
}
