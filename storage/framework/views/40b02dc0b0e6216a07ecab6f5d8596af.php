<?php $__env->startSection('title', 'Ubah Kriteria'); ?>
<?php $__env->startSection('breadcrumb', 'Dashboard / Kriteria / Ubah'); ?>
<?php $__env->startSection('heading', 'Ubah Kriteria dan Bobot'); ?>
<?php $__env->startSection('subheading', 'Edit data: '.$kriteria->kode); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.back-link', ['href' => route('verifikator.kriteria.index'), 'label' => 'Kembali ke kelola kriteria'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="mx-auto max-w-xl rounded-2xl border border-navara-100 bg-white p-8 shadow-sm">
        <form method="POST" action="<?php echo e(route('verifikator.kriteria.update', $kriteria)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <?php echo $__env->make('verifikator.kriteria._form', ['kriteria' => $kriteria, 'tipeOptions' => $tipeOptions], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="mt-8 flex gap-3">
                <button type="submit" class="rounded-xl bg-navara-500 px-6 py-2.5 text-sm font-bold text-white hover:bg-navara-600">Simpan Perubahan</button>
                <a href="<?php echo e(route('verifikator.kriteria.index')); ?>" class="rounded-xl border border-navara-200 px-6 py-2.5 text-sm font-medium text-navara-600 hover:bg-navara-50">Batal</a>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.verifikator', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\navara\resources\views/verifikator/kriteria/edit.blade.php ENDPATH**/ ?>