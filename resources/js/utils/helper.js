var currencyFormat = function currencyFormat(num) {
    var numberFormat = new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR"
    });
    var price = numberFormat.format(num);
    return price.split(",")[0];
};

var dateFormat = function dateFormat(date) {
    var options = {
        year: "numeric",
        month: "long",
        day: "numeric"
    };
    return new Date(date).toLocaleDateString("id-ID", options);
};

module.exports = {
    currencyFormat: currencyFormat,
    dateFormat: dateFormat
};
