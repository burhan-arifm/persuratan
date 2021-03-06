/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

/**
 * Route name from Ziggy
 */

import route from "ziggy";
import { Ziggy } from "./ziggy";

window.route = (name, params, absolute) => route(name, params, absolute, Ziggy);

/**
 * day.js initialization
 */
import dayjs from "dayjs";
import "dayjs/locale/id";
import localizedFormat from "dayjs/plugin/localizedFormat";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.locale("id");
dayjs.extend(localizedFormat);
dayjs.extend(relativeTime);
window.dayjs = dayjs;

/**
 * Alpine.js initialization
 */
import Alpine from "alpinejs";

window.Alpine = Alpine;

/**
 * Howler.js initialization
 */
import { Howl } from "howler";

window.Howl = Howl;

/**
 * Sheet.js initialization
 */
import * as XLSX from "xlsx";

window.XLSX = XLSX;
