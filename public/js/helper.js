const priceFormat = (num) => {
    const numberFormat = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    });
    const price = numberFormat.format(num);
    return price.split(",")[0];
};