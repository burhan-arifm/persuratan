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
    forceTLS: true
});

/**
 * Route name from Ziggy
 */

import route from "ziggy";
import { Ziggy } from "./ziggy";

window.route = (name, params, absolute) => route(name, params, absolute, Ziggy);

/**
 * Vue initialization
 */

window.Vue = require("vue");

Vue.mixin({
    methods: {
        route: (name, params, absolute) => route(name, params, absolute, Ziggy)
    }
});
