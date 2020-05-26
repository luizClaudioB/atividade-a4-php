function Layout() {
    this.brokersItem = document.getElementById('brokers-item');
    this.brokersForm = document.getElementById('broker-form');
    this.adminsItem = document.getElementById('admins-item');
    this.adminsForm = document.getElementById('admin-form');


    this.customersItem = document.getElementById('customers-item');
    this.customersForm = document.getElementById('customer-form');

    this.timeoutList = [];

    this.makeToast = function(title, message, hasError) {
        if(this.timeoutList.some(e => e.type === 'toast')) return;

        let element = document.createElement('div');
        element.id = 'toast'

        if(hasError) {
            element.classList.add('error');
        }

        element.innerHTML = `
            <h2>${title}</h2>
            <p>${message}</p>
        `;

        document.body.appendChild(element);

        let jobId = window.setTimeout((id) => {
            let element = document.getElementById('toast');
            element.parentElement.removeChild(element);
            this.timeoutList.splice(this.timeoutList.findIndex(e => e.id === id), 1);
        }, 3000);
        
        this.timeoutList.push({
            type: 'toast',
            id: jobId
        });
    }
}

Layout.getInstance = function() {
    if(Layout.instance === undefined) {
        Layout.instance = new Layout();
    }

    return Layout.instance;
}

function HttpRequest(method, endpoint) {

    this.method = method;
    this.endpoint = endpoint;

    this.setEndpoint = function(endpoint) {
        this.endpoint = endpoint;
    }

    this.setMethod = function (method) {
        this.method = method;
    }

    this.setHeaders = function(headers) {
        this.headers = headers;
    }

    this.setParameters = function(params) {
        this.parameters = typeof params === 'object' ? JSON.stringify(params) : params;
    }

    this.send = function(callback) {
        if(this.request == null) {
            this.request = this.getXmlHttpObject();
        }

        this.request.open(this.method, this.endpoint, true);
        this.request.onreadystatechange = () => {
            if(this.request.readyState === XMLHttpRequest.DONE) {
                (callback.bind(this.request))(this.request);
            }
        }

        if(this.headers !== null) {
            Object.keys(this.headers)
                .forEach(headerKey => 
                    this.request.setRequestHeader(headerKey, this.headers[headerKey])
                );
        }

        if(this.parameters !== null)
            this.request.send(this.parameters);
        else
            this.request.send();
    }
    
    this.getXmlHttpObject = function() {
        let xhr;
        
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest(); // Mozilla/Webkit/Opera
        } 
        else if (window.ActiveXObject) {
            xhr = new ActiveXObject('Msxml2.XMLHTTP'); // IE
        } 
        else {
            throw new Error('Ajax likely not supported');
        }
        return xhr;
    }
}

HttpRequest.GET    = 'GET';
HttpRequest.POST   = 'POST';
HttpRequest.PUT    = 'PUT';
HttpRequest.DELETE = 'DELETE';

HttpRequest.prototype.parameters = null;
HttpRequest.prototype.headers    = null;
HttpRequest.prototype.request    = null;

HttpRequest.getInstance = function(method, endpoint) {
    if(HttpRequest.instance === undefined || HttpRequest.instance == null) {
        HttpRequest.instance = new HttpRequest(method, endpoint);
    } else {
        if(endpoint !== undefined)
            HttpRequest.instance.setEndpoint(endpoint);
        if(method !== undefined)
            HttpRequest.instance.setMethod(method);
    }

    return HttpRequest.instance;
}

function Session() {
    this.logout = function() {
        let request = HttpRequest.getInstance(HttpRequest.POST, 'https://admin-soseguros.000webhostapp.com/index.php');
        request.setParameters('operation=logout');
        request.setHeaders({
            'content-type': 'application/x-www-form-urlencoded'
        });
        request.send(function() {
            if(this.status == 200) {
                location.reload();
            }
        });
    }

    this.sendCRUDRequest = function(operation, entity) {
        const request = HttpRequest.getInstance(HttpRequest.POST, 'https://admin-soseguros.000webhostapp.com/ws-crud.php');
        const parameters = {
            operation,
            entity
        };
        if(operation === 'create') {
            if(entity === 'admin') {
                parameters.admin_name = document.getElementById('admin-name').value;
                parameters.password = document.getElementById('password').value;
            } else if(entity === 'customer') {
                parameters.customer_name = document.getElementById('customer-name').value;
                parameters.customer_location = document.getElementById('customer-location').value;
            } else if(entity === 'broker') {
                parameters.broker_name = document.getElementById('broker-name').value;
                parameters.insurance_type = document.getElementById('insurance-type').value;
            }
        } else {
            if(entity === 'admin') {
                parameters.admin_name = document.getElementById('admin-name').value;
            } else if(entity === 'customer') {
                parameters.customer_name = document.getElementById('customer-name').value;
            } else if(entity === 'broker') {
                parameters.insurance_type = document.getElementById('insurance-type').value;
            }
        }
        
        event.preventDefault();
        
        request.setParameters(parameters);
        request.setHeaders({
            'content-type': 'application/json'
        });
        request.send(function() {
            Layout.getInstance().makeToast(this.status === 200 ? 'Requisição bem-sucedida!' : 'Erro', this.responseText, this.status !== 200);
        });
    }
    
}

Session.getInstance = function() {
    if(Session.instance === undefined) {
        Session.instance = new Session();
    }

    return Session.instance;
}