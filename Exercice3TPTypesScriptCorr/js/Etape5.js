"use strict";
// ????????????????????????????
//    Exercise 5 � Classes
// ????????????????????????????
Object.defineProperty(exports, "__esModule", { value: true });
// Objectives:
// � Create classes with typed properties and methods
// � Add access modifiers to class members
exports.default = () => {
    // ======== Exercise 5.1 ========
    // Goals:
    // � Add explicit parameter type to the greet method
    // � Add explicit return type to the greet method
    class MC {
        greet(event = 'party') {
            return `Welcome to the ${event}`;
        }
    }
    const mc = new MC();
    console.log('[Exercise 5.1]', mc.greet('show'));
    // ======== Exercise 5.2 ========
    // Goals:
    // � Add explicit parameter types to constructor
    // � Add typed parameters for storing values
    class Person {
        constructor(name, age) {
            this.name = name;
            this.age = age;
        }
    }
    const jane = new Person('Jane', 31);
    console.log('[Exercise 5.2]', `The new person's name is ${jane.name}.`);
    // ======== Exercise 5.3 ========
    // Goals:
    // � Explicitly make the title and salary properties publicly available
    // � Reduce class to three lines of code while maintaining functionality
    class Employee {
        constructor(title, salary) {
            this.title = title;
            this.salary = salary;
        }
    }
    const employee = new Employee('Engineer', 100000);
    console.log('[Exercise 5.3]', `The new employee's title is ${employee.title} and they earn $ ${employee.salary}.`);
    // ======== Exercise 5.4 ========
    // Goals:
    // � Add complete typing
    // � Make the Snake class inherit from Animal
    // � Make the Pony class inherit from Animal
    // � Make it so that the name member cannot be publicly accessed
    class Animal {
        constructor(name) {
            this.name = name;
        }
        move(meters) {
            console.log(`${this.name} moved ${meters}m.`);
        }
    }
    class Snake extends Animal {
        move(meters = 2) {
            console.log('Slithering...');
            super.move(meters);
            // should call on parent's `move` method, w/ a default
            // slither of 5 meters
        }
    }
    class Pony extends Animal {
        move(meters = 20) {
            console.log('Galloping...');
            super.move(meters);
            // should call on parent's `move` method, w/ a default
            // gallop of 60 meters
        }
    }
    // The class Animal should not be instantiable.
    // Delete or comment out once the desired error is achieved.
    const andrew = new Animal("Andrew the Animal");
    andrew.move(5);
    const sammy = new Snake("Sammy the Snake");
    sammy.move();
    // console.log(sammy.name); // Should return error
    const pokey = new Pony("Pokey the Pony");
    pokey.move(34);
    // console.log(pokey.name); // Should return error
    // ======== Exercise 5.5 ========
    // Goals:
    // � Make it so that only the Desk and Chair classes can see the
    //   manufacturer member
    class Furniture {
        constructor(manufacturer = 'IKEA') {
            this.manufacturer = manufacturer;
        }
    }
    class Desk extends Furniture {
        kind() {
            console.log('[Exercise 5.5]', `This is a desk made by ${this.manufacturer}`);
        }
    }
    class Chair extends Furniture {
        kind() {
            console.log('[Exercise 5.5]', `This is a chair made by ${this.manufacturer}`);
        }
    }
    const desk = new Desk();
    desk.kind();
    desk.manufacturer; // Should return error
    const chair = new Chair();
    chair.kind();
    chair.manufacturer; // Should return error
    // ======== Exercise 5.6 ========
    // Goals:
    // � Eliminate the error without changing references to `Student.school`
    class Student {
        constructor(name) {
            this.name = name;
        }
        ;
        introduction() {
            console.log('[Exercise 5.6]', `Hi, my name is ${this.name} and I attend ${Student.school}`);
        }
    }
    Student.school = 'Harry Herpson High School';
    const student = new Student('Morty');
    console.log(Student.school);
    student.introduction();
};
