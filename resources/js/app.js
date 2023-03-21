class Service {
    constructor() {
        this.token = this.getToken();
        this.POST = 'POST';
        this.GET = 'GET';
    }

    getData = async (api, options) => {
        const response = await fetch(api, options);
        if (response.ok) {
            return await response.json()
        } else {
            return this.createError(response)
        }
    }

    createError = (response) => {
        return {
            status: 'error',
            data: {
                url: response.url,
                ok: response.ok,
                status: response.status,
                statusText: response.statusText,
                message: 'Произошла ошибка',
            }
        }
    }


    createOptions = (method, body) => {
        const options = {
            method: method,
            headers: {
                'content-type': 'application/json; charset=UTF-8',
                'X-CSRF-Token': this.token
            }
        }
        if (body) options.body = JSON.stringify(body);
        return options;
    }

    getToken() {
        return document.querySelector('[name="csrf-token"]').content
    }


}

class Render {

    getListHtml = (getHtmlFn, arr) => {
        let list = '';
        arr.forEach((item) => {
            list += getHtmlFn(item);
        })

        return list;
    }

    _render = ($parent, getHtmlMarkup, argument = false, array = false, where = 'beforeend') => {
        let markupAsStr = '';
        if (!$parent) {
            return;
        }
        if (array) {
            array.forEach((item) => {
                markupAsStr = markupAsStr + getHtmlMarkup(item);
            })
        }
        if (!array) {
            markupAsStr = getHtmlMarkup(argument);
        }
        $parent.insertAdjacentHTML(where, markupAsStr);
    }

    clearParent = ($parent) => {
        if (!$parent) {
            return;
        }
        $parent.innerHTML = '';
    }

    delete = ($el) => {
        if (!$el) {
            return;
        }
        $el.remove()
    }

}

class Spinner extends Render {
    render = ($parent,) => {

    }


    mark = () => {
        return (`

        `)
    }

    delete = ($parent) => {
        this.clearParent($parent);
    }
}

class Body {
    constructor() {
        this.$body = document.querySelector('body');
    }

    scrollOff = () => {
        this.$body.classList.add('scroll-off')
    }

    scrollOn = () => {
        this.$body.classList.remove('scroll-off')
    }
}

class Modal {
    constructor(modalId) {
        this.$modal = document.querySelector(modalId);

        this.init();
    }

    init = () => {
        if (!this.$modal) return;
        this.$content = this.$modal.querySelector('#modalContent');
        this.body = new Body();
        this.listeners();
    }

    open = (markHtml) => {
        this.$modal.classList.add('forefront');
        this.$modal.classList.add('open');
        this.body.scrollOff();
        this.contentRender(markHtml);
    }

    contentRender = (markHtml) => {
        this.$content.innerHTML = markHtml;
    }

    clearContent = () => {
        this.$content.innerHTML = '';
    }

    close = () => {
        this.$modal.classList.remove('open');
        setTimeout(() => {
            this.$modal.classList.remove('forefront');
            this.clearContent();
            this.body.scrollOn();
            // this.hideSpinner();
        }, 200)
    }

    clickHandler = (e) => {
        if (e.target.closest('[data-modal-close]')) {
            this.close();
        }
    }
    listeners = () => {
        document.addEventListener('click', this.clickHandler);

    }
}

class TaskService extends Service {
    constructor() {
        super();
        this.baseUrl = 'tasks'
    }

    get = async (taskId) => {
        const options = this.createOptions(this.POST);
        return await this.getData(`${this.baseUrl}/${taskId}`, options);
    }

    action = async (taskId, type) => {
        const options = this.createOptions(this.POST);
        const url = `/${this.baseUrl}/${taskId}/${type}`;
        return await this.getData(url, options);
    }

}

class TaskRender extends Render {

    body = ($parent, task) => {
        this.clearParent($parent);
        this._render($parent, this.getTaskBodyHtml, task);
    }
    statusBtn = ($parent, statusData) => {
        this.clearParent($parent);
        this._render($parent, this.getStatusBtnHtml, statusData);
    }


    getStatusBtnHtml = (statusData) => {
        const {title, clsColor, clsIcon} = statusData;
        const classesBtn = ['table__btn', 'btn'];
        const classesIcon = ['table__btn-icon'];
        if (clsColor) classesBtn.push(clsColor);
        if (clsIcon) classesIcon.push(clsIcon);
        return `
            <div class="${classesBtn.join(' ')}" title="${title}">
                <i class="${classesIcon.join(' ')}"></i>
            </div>
        `
    }
    getTaskHtml = (task) => {
        const taskBody = this.getTaskBodyHtml(task);
        return `
            <div data-task="${task.id}" class="task block">
                <div data-body class="task__body">
                  ${taskBody}
                </div>
                <div data-spinner class="task__spinner">
                    <div class="spinner">
                        <div class="spinner__cubes">
                            <span class="leaf1"></span>
                            <span class="leaf2"></span>
                            <span class="leaf3"></span>
                            <span class="leaf4"></span>
                        </div>
                    </div>
                </div>
                <div data-message class="task-message block">
                    <p  data-message-text class="task-message__text"></p>
                   <button data-hide-message class="task-message__btn btn btn_small btn_red">OK</button>
                </div>
            </div>
         `
    }

    getTaskBodyHtml = (task) => {
        const {id, title, desc, status, displayBtn, info} = task;
        const btn = displayBtn ? this.getBtnHtml(status) : '';
        const infoItems = this.getListHtml(this.getInfoItemHtml, info);
        const completed = status == 3 ? '(Завершена)' : '';
        return `
            <h2 class="task__title">${title}${completed}</h2>
            <div class="task__content">

                <p class="task__description">${desc}</p>

                <div class="task-info">
                    <ul class="task-info__list">
                        ${infoItems}
                    </ul>
                </div>
            </div>

            <div class="task__controls">
                ${btn}
            </div>
        `
    }

    getTaskSkeletonHtml = () => {

        const listArr = Array(8).fill({optionalCls: 'shine', value: '&nbsp;'})
        const taskInfoList = this.getListHtml(this.getInfoEmptyItemHtml, listArr);
        return `
            <div class="task block">
              <div data-body class="task__body">
                    <h2 class="task__title shine">&nbsp;</h2>
                    <div class="task__content">
                        <p class="task__description shine">&nbsp;</p>

                        <div class="task-info">
                            <ul class="task-info__list">
                                ${taskInfoList}
                            </ul>
                        </div>
                    </div>
                    <div class="task__controls task__controls_empty shine"></div>
                </div>
            </div>
        `
    }
    getInfoItemHtml = (item) => {
        const {label, value, url} = item;
        const infoValue = this.getInfoValueHtml(value, url);
        return `
            <li class="task-info__item">
               <span class="task-info__label">${label}</span>
                ${infoValue}
            </li>
        `;
    }
    getInfoEmptyItemHtml = (item) => {
        const {optionalCls, value} = item;
        const classes = ['task-info__item'];
        if (optionalCls) classes.push(optionalCls);
        return `<li class="${classes.join(' ')}">${value}</li>`
    }

    getInfoValueHtml = (value, url) => {
        if (url) {
            return `<a href="${url}" class="task-info__value link">${value}</a>`
        }
        return `<span class="task-info__value">${value}</span>`
    }
    getBtnHtml = (status) => {
        if (status === 0) {
            return '<button data-task-action="accept" class="btn btn_blue btn_small">Приянть задачу</button>';
        }
        if (status === 1) {
            return `
                <button data-task-action="pause" class="btn btn_yellow btn_small">Приостановить</button>
                <button data-task-action="complete" class="btn btn_green btn_small">Выполнено</button>
            `;
        }

        if (status === 2) {
            return `
                 <button data-task-action="pause" class="btn btn_yellow btn_small">Продолжить</button>
                 <button data-task-action="complete" class="btn btn_green btn_small">Выполнена</button>
            `;
        }
        return '&nbsp;';
    }
    getErrorHtml = (errorData) => {
        const listArr = Array(8).fill({optionalCls: null, value: '&nbsp;'})
        const taskInfoList = this.getListHtml(this.getInfoEmptyItemHtml, listArr);

        return `
            <div class="task block">
            <div class="task__body">
               <h2 class="task__title">Ошибка</h2>
               <div class="task__content">
                  <p class="task__description">${errorData.message}</p>
                    <div class="task-info">
                        <ul class="task-info__list">
                            ${taskInfoList}
                        </ul>
                    </div>
                 </div>
                 <div class="task__controls task__controls_empty"></div>
                 </div>
            </div>
        `;
    }

}

class Task {
    constructor() {
        this.init()
    }

    init = () => {
        this.listeners();
        this.topControls = document.querySelector('[data-top-controls]');
        this.statusData = [
            {id: 0, clsColor: null, clsIcon: 'table__btn-icon_clock', title: 'В ожидании'},
            {id: 1, clsColor: 'btn_blue', clsIcon: 'table__btn-icon_clock', title: 'В работе'},
            {id: 2, clsColor: 'btn_yellow', clsIcon: 'table__btn-icon_pause', title: 'Приостановлена'},
            {id: 3, clsColor: 'btn_green', clsIcon: 'table__btn-icon_complete', title: 'Завершена'},
        ];
        this.loading = false;
        this.task = null;
        this.taskRender = new TaskRender();
        this.taskService = new TaskService();
    }

    showTask = async ($btn) => {
        if (!$btn) return;
        if (this.loading) return;

        modal.open(this.taskRender.getTaskSkeletonHtml());
        const taskId = $btn.closest('[data-task]').dataset.task;
        this.response = await this.taskService.get(taskId);
        this.responseHandler(this.renderTaskInModal, this.renderErrorInModal)();
    }

    action = async ($btn) => {
        if (this.loading) return;
        this.setTask($btn);

        this.showSpinner();
        this.response = await this.taskService.action(this.task.id, this.task.actionType);
        this.responseHandler(this.updateTask, this.actionErrorHandler)();
    }


    setTask = ($btn) => {
        if (!$btn) return
        const $task = $btn.closest('[data-task]');
        this.task = {
            actionType: $btn.dataset.taskAction,
            id: $task.dataset.task,
            $task: $task,
            $taskBody: $task.querySelector('[data-body]'),
            $messageBlock: $task.querySelector('[data-message]'),
            $messageText: $task.querySelector('[data-message-text]'),
            $spinner: $task.querySelector('[data-spinner]')
        }
    }

    actionErrorHandler = async () => {
        if (this.response.data.status === 404) {
            this.renderErrorInModal();

        } else if (this.response.data.status === 409) {
            this.showMessage();
            this.response = await this.taskService.get(this.task.id);
            this.responseHandler(this.updateTask, this.renderErrorInModal)();

        } else if (this.response.data.status === 423) {
            this.renderErrorInModal();
        }

        this.hideSpinner()
    }

    showSpinner = () => {
        if (!this.task) return;
        this.task.$spinner.classList.add('show');
        setTimeout(() => {
            this.task.$spinner.classList.add('appearance');
        }, 50)

    }

    hideSpinner = () => {
        if (!this.task) return;
        this.task.$spinner.classList.remove('appearance');
        setTimeout(() => {
            this.task.$spinner.classList.remove('show');
        },  200)
    }


    showMessage = () => {
        if (!this.task) return;
        this.task.$messageBlock.classList.add('show');
        setTimeout(() => {
            this.task.$messageBlock.classList.add('appearance');
        }, 50);

        this.task.$messageText.innerHTML = this.response.data.message;
    }

    hideMessage = () => {

        if (!this.task) return;
        this.task.$messageBlock.classList.remove('appearance');
        setTimeout(() => {
            this.task.$messageBlock.classList.remove('show');
        }, 200);
    }


    changeStatusTask = () => {
        const statusData = this.getStatusData();
        if (!statusData) return;
        this.renderStatusBtns(statusData);
    }


    removeTopControls = () => {
        if(this.topControls){
            this.taskRender.delete(this.topControls);
        }
    }

    renderTaskInModal = () => {
        const taskMark = this.taskRender.getTaskHtml(this.response.data);
        modal.contentRender(taskMark);
        this.hideSpinner()
    }


    updateTask = () => {
        if (!this.task) return
        this.taskRender.body(this.task.$taskBody, this.response.data)
        this.changeStatusTask();
        this.hideSpinner();
        if(this.response.data.status === 3){
            this.removeTopControls()
        }
    }
    renderErrorInModal = () => {
        const errorMark = this.taskRender.getErrorHtml(this.response.data);
        modal.contentRender(errorMark);
        this.hideSpinner()
    }

    getStatusData = () => {
        return this.statusData.find((item) => {
            return this.response.data.status == item.id;
        })
    }

    renderStatusBtns = (statusData) => {
        const $taskList = document.querySelectorAll(`[data-task="${this.task.id}"]`);
        $taskList.forEach($task => {
            const $statusBtn = $task.querySelector('[data-status]');
            if ($statusBtn) this.taskRender.statusBtn($statusBtn, statusData);
        })
    }


    responseHandler = (successFn, errorFn) => (argument) => {
        if (this.response.status === 'success') {
            successFn(argument);
            // this.hideSpinner(argument);
        }
        if (this.response.status === 'error') {
            errorFn(argument);
        }
    };

    clickHandler = (e) => {
        if (e.target.closest('[data-task-action]')) {
            this.action(e.target.closest('[data-task-action]'))
        }
        if (e.target.closest('[data-show-task]')) {
            this.showTask(e.target.closest('[data-show-task]'));
        }
        if (e.target.closest('[data-hide-message]')) {
            this.hideMessage();
        }

    }


    listeners = () => {
        document.addEventListener('click', this.clickHandler);
    }
}


class UserMenu {
    constructor(idUserBtn, idUserMenu) {
        this.$userBtn = document.querySelector(idUserBtn);
        this.$userMenu = document.querySelector(idUserMenu);
        this.init()
    }

    init = () => {
        if (!this.$userBtn || !this.$userMenu) return
        this.listeners();
    }
    open = () => {
        this.$userMenu.classList.add('open');
        this.$userMenu.dataset.menuStatus = 'open';
    }
    close = () => {
        this.$userMenu.classList.remove('open');
        this.$userMenu.dataset.menuStatus = 'close';
    }

    toggleMenu = (e) => {
        if (e.target.closest('#userMenu')) return;
        if (e.target.closest('#userBtn') && this.$userMenu.dataset.menuStatus === 'close') {
            this.open();
            return;
        }
        if (this.$userMenu.dataset.menuStatus === 'open') {
            this.close();
            return;
        }
    }

    listeners = () => {
        document.addEventListener('click', this.toggleMenu);
    }
}


class Select {
    constructor() {
        this.init()

    }

    init() {
        this.listeners()
    }


    open = ($select) => {
        this.closeAll();
        $select.classList.add('open');
        $select.dataset.select = 'open';
    }

    close = ($select) => {
        $select.classList.remove('open');
        $select.dataset.select = 'close';
    }

    closeAll = () => {
        const $selectList = document.querySelectorAll('[data-select]');
        $selectList.forEach(($select) => this.close($select));
    }


    toggleSelect = ($select) => {

        if ($select.dataset.select === 'open') {
            this.close($select)
        } else {
            this.open($select)
        }
        // if(e.target.closest('[data-select-btn]')){
        //     const $select = e.target.closest('[data-select]');
        //     $select.classList.toggle('open');
        // }
    }

    changeTitle = ($input) => {
        const $select = $input.closest('[data-select]');
        const $selectTitle = $select.querySelector('[data-select-title]');
        const title = $input.dataset.label;
        $selectTitle.innerHTML = title;
    }

    clickHandler = (e) => {

        if (e.target.closest('[data-select-btn]')) {
            this.toggleSelect(e.target.closest('[data-select]'))
        }

        if (!e.target.closest('[data-select-btn]')) {
            this.closeAll();
        }
    }

    changeHandler = (e) => {
        if (e.target.closest('[data-select]')) {
            this.changeTitle(e.target)
        }
    }

    listeners = () => {
        document.addEventListener('click', this.clickHandler);
        document.addEventListener('change', this.changeHandler);
    }
}


const modal = new Modal('#modal');
const userMenu = new UserMenu('#userBtn', '#userMenu');
const select = new Select();
const task = new Task();
