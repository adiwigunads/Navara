<?php $__env->startSection('title', 'Kelola Bobot & Kriteria'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard / Kelola Bobot & Kriteria'); ?>
<?php $__env->startSection('heading', 'Kelola Bobot dan Kriteria'); ?>
<?php $__env->startSection('subheading', 'Tambah, ubah, dan hapus data kriteria beserta bobot'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div class="text-sm text-navara-500">
            Total bobot: <strong class="<?php echo e(abs($totalBobot - 1) < 0.01 ? 'text-green-600' : 'text-amber-600'); ?>"><?php echo e(number_format($totalBobot, 2)); ?></strong>
            <?php if(abs($totalBobot - 1) >= 0.01): ?>
                <span class="text-amber-600">(idealnya = 1.00)</span>
            <?php endif; ?>
        </div>
        <a href="<?php echo e(route('verifikator.kriteria.create')); ?>" class="inline-flex items-center gap-2 rounded-xl bg-navara-500 px-5 py-2.5 text-sm font-bold text-white hover:bg-navara-600">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            Tambah Kriteria
        </a>
    </div>

    <div class="overflow-hidden rounded-2xl border border-navara-100 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full min-w-[700px] text-left text-sm">
                <thead class="border-b border-navara-100 bg-navara-50 text-navara-600">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Kode</th>
                        <th class="px-6 py-4 font-semibold">Nama Kriteria</th>
                        <th class="px-6 py-4 font-semibold">Tipe</th>
                        <th class="px-6 py-4 font-semibold">Bobot</th>
                        <th class="px-6 py-4 text-right font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-navara-50">
                    <?php $__empty_1 = true; $__currentLoopData = $kriteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-navara-50/60">
                            <td class="px-6 py-4 text-navara-500"><?php echo e($kriteria->firstItem() + $loop->index); ?></td>
                            <td class="px-6 py-4 font-bold text-navara-800"><?php echo e($item->kode); ?></td>
                            <td class="px-6 py-4 text-navara-700"><?php echo e($item->nama); ?></td>
                            <td class="px-6 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold <?php echo e($item->tipe === \App\KriteriaTipe::Benefit ? 'bg-green-100 text-green-800' : 'bg-orange-100 text-orange-800'); ?>">
                                    <?php echo e($item->tipe === \App\KriteriaTipe::Benefit ? 'Benefit' : 'Cost'); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-navara-700"><?php echo e(number_format($item->bobot, 2)); ?></td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="<?php echo e(route('verifikator.kriteria.edit', $item)); ?>" class="rounded-xl bg-navara-500 px-4 py-2 text-xs font-bold text-white hover:bg-navara-600">Ubah</a>
                                    <form method="POST" action="<?php echo e(route('verifikator.kriteria.destroy', $item)); ?>" onsubmit="return confirm('Yakin ingin menghapus kriteria <?php echo e($item->kode); ?>?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="rounded-xl border border-red-200 bg-red-50 px-4 py-2 text-xs font-bold text-red-700 hover:bg-red-100">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-16 text-center text-navara-500">
                                Belum ada kriteria. <a href="<?php echo e(route('verifikator.kriteria.create')); ?>" class="font-semibold text-navara-600 hover:underline">Tambah kriteria pertama</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php if($kriteria->hasPages()): ?>
        <div class="mt-6"><?php echo e($kriteria->links()); ?></div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.verifikator', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\navara\resources\views/verifikator/kriteria/index.blade.php ENDPATH**/ ?>