const Ziggy = {
    url: window.location.origin,
    // port: 8000,
    defaults: {},
    routes: {
        "data_surat.semua": {
            uri: "api/data-surat/semua",
            methods: ["GET", "HEAD"]
        },
        "data_surat.terbaru": {
            uri: "api/data-surat/terbaru",
            methods: ["GET", "HEAD"]
        },
        login: { uri: "login", methods: ["GET", "HEAD"] },
        logout: { uri: "logout", methods: ["POST"] },
        "surat.detail": { uri: "surat/{id}", methods: ["GET", "HEAD"] },
        "surat.cetak": { uri: "surat/{id}/cetak", methods: ["GET", "HEAD"] },
        "surat.sunting": {
            uri: "surat/{id}/sunting",
            methods: ["GET", "HEAD"]
        },
        "surat.hapus": { uri: "surat/{id}", methods: ["DELETE"] }
    }
};

if (typeof window !== "undefined" && typeof window.Ziggy !== "undefined") {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };
