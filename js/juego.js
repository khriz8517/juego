var app = new Vue({
    el: "#app",
    delimiters: ["{(", ")}"],
    data: {
        HTMLcontent: "",
        cursoid: 0,
        puntaje: 0,
    },
    created() {},
    methods: {
        juegoFinalizado: function () {
            let frm = new FormData();
            frm.append("request_type", "actualizarEstadoJuegoByUser");
            frm.append("cursoid", this.cursoid);
            frm.append("puntaje", this.puntaje);
            frm.append("sesskey", sesskey);
            axios.post("api/ajax_controller.php", frm).then((res) => {});
        },
    },
});
