"use strict";
class Calendar {
    constructor(section) {
        this.section = section;
        this.months = ['jan', 'fev', 'mar', 'avr', 'mai', 'juin', 'juil', 'aout', 'sep', 'oct', 'nov', 'dec'];
        this.days = ['dim', 'lun', 'mar', 'mer', 'jeu', 'ven', 'sam'];
        this.minusMonth = () => {
            let newDate = new Date(this.date.getFullYear(), this.date.getMonth() - 1, this.date.getDate());
            this.reset(newDate);
            this.create();
        };
        this.minusYear = () => {
            let newDate = new Date(this.date.getFullYear() - 1, this.date.getMonth(), this.date.getDate());
            this.reset(newDate);
            this.create();
        };
        this.addMonth = () => {
            let newDate = new Date(this.date.getFullYear(), this.date.getMonth() + 1, this.date.getDate());
            this.reset(newDate);
            this.create();
        };
        this.addYear = () => {
            let newDate = new Date(this.date.getFullYear() + 1, this.date.getMonth(), this.date.getDate());
            this.reset(newDate);
            this.create();
        };
        this.date = new Date();
        this.section = section;
    }
    setDate(date) {
        this.date = date;
    }
    daysInMonth(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }
    firstDayOfMonth() {
        return new Date(this.date.getFullYear(), this.date.getMonth(), 1).getDay();
    }
    previousMonthDays() {
        this.daysInMonth(this.date.getFullYear(), this.date.getMonth() - 1) - this.firstDayOfMonth() + 1;
    }
    reset(date) {
        this.section.innerHTML = "";
        this.date = date;
    }
    create() {
        var table = document.createElement('table');
        this.section.appendChild(table);
        this.createHeader(table);
        this.createBody(table);
    }
    createHeader(table) {
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
    createBody(table) {
        var firstDay = this.firstDayOfMonth();
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
                }
                else if (numero <= this.daysInMonth(this.date.getFullYear(), this.date.getMonth())) {
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
                }
                else {
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
    constructor(calendar) {
        this.calendar = calendar;
    }
    displayCalendar(date = this.calendar.date) {
        this.calendar.reset(date);
        this.calendar.create();
    }
}
var calendrier = document.querySelector("#calendrier");
if (calendrier) {
    var app = new App(new Calendar(calendrier));
    app.displayCalendar();
}
//# sourceMappingURL=data:application/json;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoiQXBwLmpzIiwic291cmNlUm9vdCI6IiIsInNvdXJjZXMiOlsiLi4vc2NyaXB0cy9BcHAudHMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IjtBQU9BLE1BQU0sUUFBUTtJQUtWLFlBQW1CLE9BQWdCO1FBQWhCLFlBQU8sR0FBUCxPQUFPLENBQVM7UUFIbkMsV0FBTSxHQUFHLENBQUMsS0FBSyxFQUFFLEtBQUssRUFBRSxLQUFLLEVBQUUsS0FBSyxFQUFFLEtBQUssRUFBRSxNQUFNLEVBQUUsTUFBTSxFQUFFLE1BQU0sRUFBRSxLQUFLLEVBQUUsS0FBSyxFQUFFLEtBQUssRUFBRSxLQUFLLENBQUMsQ0FBQztRQUNqRyxTQUFJLEdBQUcsQ0FBQyxLQUFLLEVBQUUsS0FBSyxFQUFFLEtBQUssRUFBRSxLQUFLLEVBQUUsS0FBSyxFQUFFLEtBQUssRUFBRSxLQUFLLENBQUMsQ0FBQztRQXdCakQsZUFBVSxHQUFHLEdBQUcsRUFBRTtZQUN0QixJQUFJLE9BQU8sR0FBRyxJQUFJLElBQUksQ0FBQyxJQUFJLENBQUMsSUFBSSxDQUFDLFdBQVcsRUFBRSxFQUFFLElBQUksQ0FBQyxJQUFJLENBQUMsUUFBUSxFQUFFLEdBQUUsQ0FBQyxFQUFFLElBQUksQ0FBQyxJQUFJLENBQUMsT0FBTyxFQUFFLENBQUMsQ0FBQztZQUM5RixJQUFJLENBQUMsS0FBSyxDQUFDLE9BQU8sQ0FBQyxDQUFDO1lBQ3BCLElBQUksQ0FBQyxNQUFNLEVBQUUsQ0FBQTtRQUNqQixDQUFDLENBQUE7UUFFTyxjQUFTLEdBQUcsR0FBRyxFQUFFO1lBQ3JCLElBQUksT0FBTyxHQUFHLElBQUksSUFBSSxDQUFDLElBQUksQ0FBQyxJQUFJLENBQUMsV0FBVyxFQUFFLEdBQUcsQ0FBQyxFQUFFLElBQUksQ0FBQyxJQUFJLENBQUMsUUFBUSxFQUFFLEVBQUUsSUFBSSxDQUFDLElBQUksQ0FBQyxPQUFPLEVBQUUsQ0FBQyxDQUFDO1lBQy9GLElBQUksQ0FBQyxLQUFLLENBQUMsT0FBTyxDQUFDLENBQUM7WUFDcEIs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