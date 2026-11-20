export const formatRupiah = (n) =>
    new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        maximumFractionDigits: 0,
    }).format(n ?? 0);

export const waLink = (number, text) =>
    `https://wa.me/${number}?text=${encodeURIComponent(text)}`;
