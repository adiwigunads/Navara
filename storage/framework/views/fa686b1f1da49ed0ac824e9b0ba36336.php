<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['kriteria' => null, 'tipeOptions']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['kriteria' => null, 'tipeOptions']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="space-y-5">
    <div>
        <label for="kode" class="mb-1.5 block text-sm font-medium text-navara-700">Kode Kriteria</label>
        <input type="text" id="kode" name="kode" value="<?php echo e(old('kode', $kriteria?->kode)); ?>" required maxlength="10" placeholder="C1"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 uppercase focus:border-navara-400 focus:outline-none">
        <?php $__errorArgs = ['kode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="nama" class="mb-1.5 block text-sm font-medium text-navara-700">Nama Kriteria</label>
        <input type="text" id="nama" name="nama" value="<?php echo e(old('nama', $kriteria?->nama)); ?>" required
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="tipe" class="mb-1.5 block text-sm font-medium text-navara-700">Tipe</label>
        <select id="tipe" name="tipe" required class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
            <?php $__currentLoopData = $tipeOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tipe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($tipe->value); ?>" <?php if(old('tipe', $kriteria?->tipe?->value) === $tipe->value): echo 'selected'; endif; ?>>
                    <?php echo e($tipe === \App\KriteriaTipe::Benefit ? 'Benefit' : 'Cost'); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['tipe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div>
        <label for="bobot" class="mb-1.5 block text-sm font-medium text-navara-700">Bobot (0 – 1)</label>
        <input type="number" id="bobot" name="bobot" value="<?php echo e(old('bobot', $kriteria?->bobot)); ?>" required step="0.01" min="0.01" max="1"
            class="w-full rounded-xl border border-navara-200 bg-navara-50 px-4 py-3 focus:border-navara-400 focus:outline-none">
        <?php $__errorArgs = ['bobot'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<?php /**PATH C:\laragon\www\navara\resources\views/verifikator/kriteria/_form.blade.php ENDPATH**/ ?>