new Vue({
    delimiters: ['{!', '!}'],
    el: '#crud-solicitud-egreso',
    // el: '#data-solicitud-reembolso',

    created: function () {
        this.getSolicitudesEgreso();
        this.getOpcionesEgreso();
        this.getTorneoCategoriaJornada();
        this.onChangeCuentasContable();
        this.getTipoSolicitud();
    },
    data: {

        EgresoList: [],
        EgresosList: [],
        Totales: [],
        EgresoDescripcionList: [],
        TotalesDescripcion: [],
        cuentasList: [],
        tipoSolicitudList: [],

        TorneoList:[],
        CategoriaList: [],
        JornadaList: [],
        DireccionList: [],
        CoList: [],
        CcList: [],

        Solicitante: null,
        FormaDePago: null,
        AreaSolicitante: null,
        TipoDeInforme: null,
        CentroOrganizativo: null,
        NumeroDeTarjeta: null,
        CentroDeCosto: null,
        MotivoDeLaCompra: null,
        Torneo: null,
        Especifique: null,
        Categoria: null,
        Importe: null,
        Jornada: null,
        Direccion: null,
        FechaDePago: null,

        options: [],

        isHidden: true,
        isInformacionHidden: false,
        isGastosHidden: false,
        isInformacionGastosHidden: false,
        isTarjetaHidden: false,

        alimentos: null,
        facturado: null,
        presupuesto: null,
        real: null,
        isLoading: false,

        lists: [],
        elnombre: null,


    },
    mounted() {

    },
    watched: {

    },

    computed: {
    },

    methods: {

        onChangeFormaDePago: function(pago) {

            if (pago == 'Deposito a Tarjeta') {
                this.isTarjetaHidden = true;
            }else {
                this.isTarjetaHidden = false;
            }
        },

        onChangeCuentasContable: function (){

            var url = '/api/solicitud-egreso';
            axios.get(url, { params: {opcion: 'cuentas-contables'} }).then((response) => {
                this.cuentasList = response.data;
            }).catch(error => {
                console.log(error);
            })
        },
        onChangeCentroOrganizativo: function (direccion) {

            var url = '/api/solicitud-egreso';
            axios.get(url, { params: { opcion: 'centro-organizativo-direccion',  direccion: direccion } }).then((response) => {

                this.CoList = response.data.co; //this.CoList;
                console.log(response.data.co);

            }).catch(error => {
                this.errors = 'Error al obtener las Listas de Opciones';
            });
        },
        onChangeCentroCosto: function (centro) {

            var url = '/api/solicitud-egreso';
            axios.get(url,  { params: { opcion: 'centro-costo', centro: centro }}).then((response) => {
                this.CcList  = response.data.cc;
                this.options = response.data.cc;

            }).catch(error => {
                this.errors = 'Error al obtener las Listas de Opciones';
            });
        },

        getOpcionesEgreso: function () {

            var url = '/api/solicitud-egreso';
            axios.get(url, {params: { opcion: 'direccion' } }).then((response) => {
                this.DireccionList = response.data.direccion;

            }).catch(error => {
               this.errors = 'Error al obtener las Listas de Opciones';
               console.log(error);
            });
        },


        //
        // Metodo para obtener todas las solicitudes de egresos
        //
        getTipoSolicitud: function (){

            var url = '/api/solicitud-egreso';

            axios.get(url, {params: {opcion: 'tipo-solicitud'} }).then((response) => {
                this.tipoSolicitudList = response.data;

            }).catch(error => {
                console.log(error);
            })
        },

        getSolicitudesEgreso: function () {
            var url = '/api/solicitud-egreso';

            axios.get(url).then(response => {

                this.EgresosList = response.data;

            }).catch(error => {
                this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                console.log(error);
            });

        },

        getTorneoCategoriaJornada: function () {

            var url = '/api/solicitud-egreso';

            axios.get(url, {params: { opcion: 'torneo-categoria-jornada'} }).then(response => {
                this.TorneoList = response.data.torneo;
                this.CategoriaList = response.data.categoria;
                this.JornadaList = response.data.jornada;

                console.log(response.data);

            }).catch(error => {
                this.errors = 'Erro al obtener la inforamacion del Torneo/Categoria/Jornada';
                console.log(error);
            });

        },

        postSolicitudEgreso: function () {

            const params = {

                FormaDePago:        this.FormaDePago,
                TipoDeInforme:      this.TipoDeInforme,
                CentroOrganizativo: this.CentroOrganizativo,
                NumeroDeTarjeta:    this.NumeroDeTarjeta,
                CentroDeCosto:      this.CentroDeCosto,
                MotivoDeLaCompra:   this.MotivoDeLaCompra,
                Torneo:             this.Torneo,
                Especifique:        this.Especifique,
                Categoria:          this.Categoria,
                Importe:            this.Importe,
                Jornada:            this.Jornada,
                Direccion:          this.Direccion,
                FechaDePago:        this.FechaDePago,

            };

            var url = '/nueva-solicitud-de-egresos';

            axios.post(url, params).then(response => {

                this.EgresoList = response.data;
                this.id = response.data[0]['Id'];

                this.isHidden = false;
                this.isInformacionHidden = true;
                this.isGastosHidden = true;

                console.log(response.data);
                this.errors = [];
            }).catch(error => {
                this.errors = 'Corrija para poder crear con éxito'
                console.log(error);
            });
        },

        //
        //Captura informacion de gastos de la solicitud
        //

        // postCapturaGastos: function () {
        //
        //     const params = {
        //         Alimentos: this.alimentos,
        //         Facturado: this.facturado,
        //         Presupuesto: this.presupuesto,
        //         Real: this.real,
        //         Total: this.total,
        //         Id: this.id,
        //
        //     };

        //     var url = '/api/nuevo-registro-egreso-descripcion';
        //
        //     axios.post(url, params).then(response => {
        //         this.EgresoDescripcionList = response.data.descripcion;
        //         //aqui totales
        //         this.TotalesDescripcion = response.data.totales;
        //
        //
        //         this.isFacturacionHidden = true;
        //         this.isInformacionGastosHidden = true;
        //         console.log(response.data);
        //         this.errors = [];
        //     }).catch(error => {
        //         this.errors = 'Corrija para poder crear con éxito';
        //         console.log(error);
        //     });
        // },


        onClickDeleteSolicitud: function (solicitud) {

            let url = '/api/eliminar-solicitud-anticipo-reembolso/' + solicitud.Id;

            axios.delete(url).then(response => {
                this.getSolicitudesReembolso();
                console.log(response.data);
            }).catch(error => {
                this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                console.log(error);
            });
        },

        onClickShowSolicitudEgresos: function (solicitud) {


            let url = '/api/mostrar-solicitud-egresos/' + solicitud.Id;

            axios.get(url).then(response => {

                this.EgresoList = response.data.forma;

                this.EgresoDescripcionList = response.data.descripcion;

                //checar este fix con ashly

                // if(response.data.descripcion = "No existen datos en la Solicitud")
                // {
                //     this.isGastosHidden = true;
                // }
                // this.id = response.data.forma[0]['Id'];
                // console.log('solin' + this.id);

                this.Totales = response.data.totales;
                this.isGastosHidden = true;
                console.log(response.data);


            }).catch(error => {
                this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                console.log(error);
            });

        },
    }, //fin de methods

})
;
