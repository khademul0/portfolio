<div class="rounded-2xl border border-slate-200 dark:border-white/10 p-6 bg-white/70 dark:bg-slate-950/30">
  @if (session('success'))
    <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 text-emerald-900 px-4 py-3 text-sm">
      {{ session('success') }}
    </div>
  @endif

  <form wire:submit.prevent="submit" class="space-y-4">
    <div class="grid md:grid-cols-2 gap-4">
      <div>
        <label class="text-sm font-medium">Name</label>
        <input wire:model.defer="name" type="text"
               class="mt-2 w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-950 px-4 py-3 text-sm">
        @error('name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="text-sm font-medium">Email</label>
        <input wire:model.defer="email" type="email"
               class="mt-2 w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-950 px-4 py-3 text-sm">
        @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
      </div>
    </div>

    <div>
      <label class="text-sm font-medium">Subject (optional)</label>
      <input wire:model.defer="subject" type="text"
             class="mt-2 w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-950 px-4 py-3 text-sm">
      @error('subject') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
      <label class="text-sm font-medium">Message</label>
      <textarea wire:model.defer="message" rows="5"
                class="mt-2 w-full rounded-xl border border-slate-200 dark:border-white/10 bg-white dark:bg-slate-950 px-4 py-3 text-sm"></textarea>
      @error('message') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
    </div>

    <button class="w-full rounded-xl bg-slate-900 text-white dark:bg-white dark:text-slate-900 px-5 py-3 text-sm font-semibold hover:opacity-90 transition">
      <span wire:loading.remove>Send Message</span>
      <span wire:loading>Sending...</span>
    </button>
  </form>
</div>
