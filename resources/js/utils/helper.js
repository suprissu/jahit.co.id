const currencyFormat = num => {
    const numberFormat = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    });
    const price = numberFormat.format(num);
    return price.split(",")[0];
};

const dateFormat = date => {
    const options = {
        year: "numeric",
        month: "long",
        day: "numeric"
    };
    return new Date(date).toLocaleDateString("id-ID", options);
};

module.exports = {
    currencyFormat,
    dateFormat
};
