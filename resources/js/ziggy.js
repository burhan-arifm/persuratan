const Ziggy = {"url":"http:\/\/127.0.0.1:8000","port":8000,"defaults":{},"routes":{"logout":{"uri":"logout","methods":["POST"]},"surat.detail":{"uri":"surat\/{id}","methods":["GET","HEAD"]},"surat.cetak":{"uri":"surat\/{id}\/cetak","methods":["GET","HEAD"]},"surat.sunting":{"uri":"surat\/{id}\/sunting","methods":["GET","HEAD"]},"surat.hapus":{"uri":"surat\/{id}","methods":["DELETE"]},"pengaturan.admin.reset":{"uri":"pengaturan\/admin\/{id}\/password-reset","methods":["GET","HEAD"]},"pengaturan.admin.hapus":{"uri":"pengaturan\/admin\/{id}","methods":["DELETE"]}}};

if (typeof window !== 'undefined' && typeof window.Ziggy !== 'undefined') {
    for (let name in window.Ziggy.routes) {
        Ziggy.routes[name] = window.Ziggy.routes[name];
    }
}

export { Ziggy };
