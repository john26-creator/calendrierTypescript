interface ICalendar {
    date: Date;
    months: Array<string>;
    days: Array<string>;
    section: Element;
}

class Calendar implements ICalendar {
    public date: Date;
    months = ['jan', 'fev', 'mar', 'avr', 'mai', 'juin', 'juil', 'aout', 'sep', 'oct', 'nov', 'dec'];
    days = ['dim', 'lun', 'mar', 'mer', 'jeu', 'ven', 'sam'];

    constructor(public section: Element) {
        this.date = new Date();
        this.section = section;
    }

    setDate(date: Date): void {
        this.date = date;
    }


    daysInMonth(year: number, month: number): number {
        return new Date(year, month + 1, 0).getDate();
    }

    firstDayOfMonth(): number {
        return new Date(this.date.getFullYear(), this.date.getMonth(), 1).getDay();
    }

    previousMonthDays() {
        this.daysInMonth(this.date.getFullYear(), this.date.getMonth() - 1) - this.firstDayOfMonth() + 1;
    }

    private minusMonth = () => {
        let newDate = new Date(this.date.getFullYear(), this.date.getMonth() -1, this.date.getDate());
        this.reset(newDate);
        this.create()
    }

    private minusYear = () => {
        let newDate = new Date(this.date.getFullYear() - 1, this.date.getMonth(), this.date.getDate());
        this.reset(newDate);
        this.create()
    }

    private addMonth = () => {
        let newDate =  new Date(this.date.getFullYear(), this.date.getMonth()+1, this.date.getDate());
        this.reset(newDate);
        this.create()
    }

    private addYear = () => {
        let newDate = new Date(this.date.getFullYear() + 1, this.date.getMonth(), this.date.getDate());
        this.reset(newDate);
        this.create()
    }

    reset(date: Date) {
        this.section.innerHTML = "";
        this.date = date;
    }

    create() {
        var table = document.createElement('table');
        this.section.appendChild(table);
        this.createHeader(table);
        this.createBody(table);
    }

    private createHeader(table: Element): void {
        var tr = document.createElement('tr');
        table.appendChild(tr);

        var th = document.createElement('th');
        // on fusionne 2 cellules
        th.setAttribute('colspan', '2');

        // on attribue un boutton avec un evenement
        var button = document.createElement("button");
        button.innerHTML = "<<";
        button.setAttribute("id", "moinsUnAn");
        th.appendChild(button);
        button.addEventListener("click", this.minusYear);

        // on attribue un boutton avec un evenement
        button = document.createElement("button");
        button.innerHTML = "<";
        button.setAttribute("id", "moinsUnMoi");
        button.addEventListener("click", this.minusMonth);

        th.appendChild(button);

        tr.appendChild(th);

        th = document.createElement('th');
        th.setAttribute('colspan', '3');
        tr.appendChild(th);


        // on met ce qu'on veut
        th.innerHTML = this.months[this.date.getMonth()] + ' ' + this.date.getFullYear();

        th = document.createElement('th');
        th.setAttribute('colspan', '2');
        // on attribue un boutton avec un evenement

        button = document.createElement("button");
        button.innerHTML = ">";
        button.setAttribute("id", "plusUnMois");
        button.addEventListener("click", this.addMonth);
        
        th.appendChild(button);
        button = document.createElement("button");
        button.innerHTML = ">>";
        button.setAttribute("id", "plusUnAn");

        button.addEventListener("click", this.addYear);

        th.appendChild(button);

        tr.appendChild(th);

        tr = document.createElement('tr');
        table.appendChild(tr);


        for (var i = 0; i < this.days.length; i++) {
            th = document.createElement("th");
            th.innerHTML = this.days[i];
            tr.appendChild(th);
        }
    }

    private createBody (table:Element) {
        var firstDay: number = this.firstDayOfMonth();
        var numero = 1;
        // variable permettant d'afficher les jours du mois suivant
        var nextMonth = 1;
        // variable permettant d'afficher les jours du mois précédent
        var previousMonth = this.daysInMonth(this.date.getFullYear(), this.date.getMonth() - 1) - firstDay + 1;

        for (var i = 0; i < 6; i++) {
            var tr = document.createElement('tr');
            table.appendChild(tr);
            for (var j = 0; j < 7; j++) {
                var td = document.createElement('td');
                tr.appendChild(td);
                // console.log(i);
                if (i == 0 && j < firstDay) {
                    td.innerHTML = "" + previousMonth++;
                    td.className = "otherMonth";
                } else if (numero <= this.daysInMonth(this.date.getFullYear(), this.date.getMonth())) {
                    td.innerHTML = `${numero}`;
                    // Si j'arrive au dernier jour je ne rajoute pas d'autres lignes 
                    if (numero == this.daysInMonth(this.date.getFullYear(), this.date.getMonth())) {
                        i = 6;
                    }
                    // alert(new Date(d.getFullYear(), d.getMonth(), d.getDate()));
                    // si aujourdhui tombe a ce moment il faut le mettre en valeur
                    var aujourdhui = new Date();
                    if (aujourdhui.getFullYear() == this.date.getFullYear() && aujourdhui.getMonth() == this.date.getMonth() && aujourdhui.getDate() == numero) {
                        td.className = "aujourdhui";
                    }
                    numero++;
                } else {
                    // je rajoute les numéros du mois suivant si besoin
                    td.innerHTML = `${nextMonth++}`;
                    td.className = "otherMonth";
                    i = 6;
                }
            }
        }
    }

}

class App {

    constructor(public calendar: Calendar) {}

    displayCalendar(date: Date = this.calendar.date) {
        this.calendar.reset(date);
        this.calendar.create();
    }

}

var calendrier = document.querySelector("#calendrier");
if (calendrier) {
    var app:App = new App(new Calendar(calendrier));
    app.displayCalendar();
}