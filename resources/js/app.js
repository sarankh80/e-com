import './bootstrap';
import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import focus from '@alpinejs/focus';

window.Alpine = Alpine;
Alpine.plugin(persist);
Alpine.plugin(focus);

/* ── Theme (dark/light) ───────────────────────────────────── */
Alpine.store('theme', {
    dark: Alpine.$persist(false).as('shop_dark'),
    toggle() {
        this.dark = !this.dark;
        this.apply();
    },
    apply() {
        document.documentElement.classList.toggle('dark', this.dark);
    },
    init() { this.apply(); }
});

/* ── Cart store ─────────────────────────────────────────────── */
Alpine.store('cart', {
    open: false,
    count: 0,
    items: [],

    async load() {
        try {
            const r = await fetch('/api/cart', { headers: { 'X-Requested-With': 'XMLHttpRequest' } });
            const data = await r.json();
            this.items = data.items || [];
            this.count = data.count || 0;
        } catch {}
    },

    async add(productId, variantId = null, qty = 1) {
        try {
            const r = await fetch('/api/cart', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                body: JSON.stringify({ product_id: productId, variant_id: variantId, qty })
            });
            const data = await r.json();
            if (data.success) {
                this.items = data.items;
                this.count = data.count;
                this.open = true;
                Alpine.store('toast').show('Item added to cart', 'success');
            }
        } catch {}
    },

    async remove(itemId) {
        try {
            await fetch(`/api/cart/${itemId}`, {
                method: 'DELETE',
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            this.items = this.items.filter(i => i.id !== itemId);
            this.count = this.items.reduce((s, i) => s + i.qty, 0);
        } catch {}
    },

    get subtotal() {
        return this.items.reduce((s, i) => s + (parseFloat(i.price) * i.qty), 0);
    },
    get subtotalFormatted() {
        return '$' + this.subtotal.toFixed(2);
    }
});

/* ── Wishlist store ─────────────────────────────────────────── */
Alpine.store('wishlist', {
    open: false,
    ids: Alpine.$persist([]).as('shop_wishlist'),

    toggle(id) {
        if (this.ids.includes(id)) {
            this.ids = this.ids.filter(i => i !== id);
            Alpine.store('toast').show('Removed from wishlist', 'info');
        } else {
            this.ids = [...this.ids, id];
            Alpine.store('toast').show('Added to wishlist', 'success');
        }
    },
    has(id) { return this.ids.includes(id); }
});

/* ── Toast store ─────────────────────────────────────────────── */
Alpine.store('toast', {
    queue: [],
    show(message, type = 'success', duration = 3000) {
        const id = Date.now();
        this.queue.push({ id, message, type });
        setTimeout(() => this.dismiss(id), duration);
    },
    dismiss(id) {
        this.queue = this.queue.filter(t => t.id !== id);
    }
});

/* ── Page transition ─────────────────────────────────────────── */
document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('main')?.classList.add('page-enter');

    Alpine.store('theme').apply();
    Alpine.store('cart').load();
});

/* ── Lazy load images ─────────────────────────────────────────── */
if ('IntersectionObserver' in window) {
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                const img = e.target;
                if (img.dataset.src) {
                    img.src = img.dataset.src;
                    img.removeAttribute('data-src');
                    img.classList.remove('skeleton');
                    observer.unobserve(img);
                }
            }
        });
    }, { rootMargin: '200px' });

    document.querySelectorAll('img[data-src]').forEach(img => observer.observe(img));
}

Alpine.start();
