<?php

namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Models\Peminjaman;

class ChartPeminjaman
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $jumlahPeminjaman = Peminjaman::count();
        $jumlahKembali = Peminjaman::where('status', 'Sudah Dikembalikan')->count();
        $jumlahBelumKembali = Peminjaman::where('status', 'Belum Dikembalikan')->count();

        return $this->chart->donutChart()
            ->setTitle('Statistik Peminjaman')
            ->setWidth(500)
            ->addData([$jumlahPeminjaman, $jumlahKembali, $jumlahBelumKembali])
            ->setLabels(['Jumlah Peminjaman', 'Jumlah Sudah Kembali', 'Jumlah Belum Kembali']);
    }
}
