
new Vue({
    delimiters: ['{!', '!}'],
    el: '#solicitud-producto',
    // el: '#data-solicitud-reembolso',

    created: function () {
        this.onClickShowSolicitudProducto();
    },
    data: {

        ProductoDescripcion: [],
        DepositoList: [],


        TotalesDescripcion: [],
        TotalDeposito: '',

        // facturacion
        proveedor:null,
        tipoGasto: null,
        cuentaClabe: null,
        banco: null,


        options: [],

        isHidden: true,
        isInformacionHidden: false,
        isGastosHidden: false,
        isInformacionGastosHidden: false,
        isTarjetaHidden: false,
        isHiddenDescripcion: true,
        isDespositoHidden: false,

        cuenta: null,
        descripcion: null,
        presupuesto: null,
        precio: null,
        isLoading: false,

        id :  $("#solicitud").attr('value'),
        idDeposito: '',

    },



    methods: {

        changeId: function(item){
            let v = this.idDeposito = item.id;
            console.log(item.id);
            return this.idDeposito;

        },

        postCapturaFacturacion: function () {

            const params = {
                // facturacion
                Proveedor:  this.proveedor,
                TipoGasto: this.tipoGasto,
                CuentaClabe: this.cuentaClabe,
                Banco: this.banco,
                Deposito: this.idDeposito,

            };

            var url = '/api/xxxagregar-informacion-producto';

            axios.post(url, params).then(response => {

                toastr.success('Click Button');
                this.onClickShowSolicitudProducto();
                $('.modal-xl').modal('hide');
                this.errors = [];
				
				console.log(response.data);
				
            }).catch(error => {
                this.errors = 'Corrija para poder crear con éxito'
                console.log(error);
            });
        },


        postCapturaProducto: function () {

            const params = {
                Cuenta: this.cuenta,
                Facturado: this.descripcion,
                Presupuesto: this.presupuesto,
                Real: this.precio,
                Total: this.total,
                Id: this.id,
            };
//agregar-informacion-producto
//nuevo-registro-egreso-descripcion
            var url = '/api/agregar-informacion-producto';

            axios.post(url, params).then(response => {
                this.ProductoDescripcion = response.data.descripcion;
                //aqui totales
                this.TotalesDescripcion = response.data.totales;

                this.isFacturacionHidden = true;
                this.isInformacionGastosHidden = true;
                console.log(response.data);
                this.errors = [];

            }).catch(error => {
                this.errors = 'Corrija para poder crear con éxito';
                console.log(error);
            });
        },


/*        onClickDeleteSolicitud: function (solicitud) {

            let url = '/api/eliminar-solicitud-anticipo-reembolso/' + solicitud.Id;

            axios.delete(url).then(response => {
                this.getSolicitudesReembolso();
                console.log(response.data);
            }).catch(error => {
                this.errors = 'Erro al obtener la inforamacion de las solicitudes';
                console.log(error);
            });
        },*/

        onClickShowSolicitudProducto: function () {

            var item =  $("#solicitud").attr('value')
            this.isInformacionGastosHidden = true;

            let url = '/api/mostrar-solicitud-producto/' + item;

            axios.get(url).then(response => {

                this.EgresoList = response.data.forma;
                this.ProductoDescripcion = response.data.descripcion;
                this.TotalesDescripcion = response.data.totales;

                if(response.data.deposito){
                    this.isDespositoHidden = true;
                    this.DepositoList = response.data.deposito;
                    this.TotalDeposito = response.data.totalDeposito;

                }


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
