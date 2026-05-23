import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

/*
|--------------------------------------------------------------------------
| Global Helpers
|--------------------------------------------------------------------------
*/

window.formatCurrency = (value) => {
    return new Intl.NumberFormat("id-ID", {
        style: "currency",
        currency: "IDR",
    }).format(value);
};

window.formatDate = (date) => {
    return new Date(date).toLocaleDateString("id-ID");
};

/*
|--------------------------------------------------------------------------
| Alpine Start
|--------------------------------------------------------------------------
*/

Alpine.start();
