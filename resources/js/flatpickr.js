import flatpickr from "flatpickr";
import { Indonesian } from "flatpickr/dist/l10n/id";

const now = new Date();

flatpickr.localize(Indonesian);
flatpickr("[data-picker|=date]", {
    altFormat: "l, d F Y",
    altInput: true,
    ariaDateFormat: "l, d F Y",
    dateFormat: "Y-m-d",
    defaultDate: now,
    prevArrow: `<i class="ph-caret-left-bold"></i>`,
    nextArrow: `<i class="ph-caret-right-bold"></i>`,
});
flatpickr("[data-picker|=time]", {
    altFormat: "H:i \\W\\IB",
    altInput: true,
    ariaDateFormat: "H:i",
    dateFormat: "H:i:S",
    defaultDate: now.getTime(),
    enableTime: true,
    noCalendar: true,
    time_24hr: true,
});
flatpickr("[data-picker|=datetime]", {
    altFormat: "l, d F Y P\\u\\k\\u\\l H:i \\W\\IB",
    altInput: true,
    ariaDateFormat: "l, d F Y",
    enableTime: true,
    dateFormat: "Y-m-d H:i:S",
    time_24hr: true,
    defaultDate: now,
});
flatpickr("[data-picker|=daterange]", {
    altFormat: "l, d F Y",
    altInput: true,
    ariaDateFormat: "l, d F Y",
    dateFormat: "Y-m-d",
    defaultDate: [now, new Date(now).setDate(now.getDate() + 3)],
    mode: "range",
    prevArrow: `<i class="ph-caret-left-bold"></i>`,
    nextArrow: `<i class="ph-caret-right-bold"></i>`,
});
