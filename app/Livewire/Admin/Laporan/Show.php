<?php

namespace App\Livewire\Admin\Laporan;

use App\Livewire\AdminPage;
use App\Models\Laporan;
use App\Services\ComplaintManager;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Locked;

class Show extends AdminPage
{
    #[Locked]
    public int $laporanId;

    public function mount(Laporan $laporan): void
    {
        $this->authorize('changeStatus', $laporan);
        $this->laporanId = $laporan->id;
    }

    public function changeStatus(string $status): void
    {
        app(ComplaintManager::class)->transition($this->laporanId, $status);
        session()->flash('success', 'Status pengaduan berhasil diperbarui.');
    }

    public function delete(): void
    {
        app(ComplaintManager::class)->delete($this->laporanId);
        session()->flash('success', 'Pengaduan yang sudah selesai berhasil dihapus.');
        $this->redirectRoute('admin.laporan.index', navigate: true);
    }

    public function render(): View
    {
        $laporan = Laporan::with('pelapor')->findOrFail($this->laporanId);
        $this->authorize('changeStatus', $laporan);

        return view('livewire.admin.laporan.show', compact('laporan'))->title('Tinjau Pengaduan');
    }
}
