"use strict";
// ????????????????????????????
//   Exercise 2 � Interfaces
// ????????????????????????????
Object.defineProperty(exports, "__esModule", { value: true });
// Objectives:
// � Demonstrate structural typing (duck typing)
// � Create an interface and implement it on a class
// � Differentiate type aliases from interfaces
exports.default = () => {
    // ======== Exercise 2.1 ========
    // Instructions:
    // � Create an interface `CartItem` and replace the param's type with it
    // � Make variantId optional
    function addToCart(item) {
        console.log('[Exercise 2.1]', `Adding "${item.title}" to cart.`);
    }
    addToCart({ id: 1, title: 'Concrete shoes' });
    class Person {
        constructor(name, age) {
            this.name = name;
            this.age = age;
        }
    }
    const jane = new Person('Jane', 31);
    console.log('[Exercise 2.2]', `${jane.name} is ${jane.age} years old.`);
    // [/do not edit]
    const montreal = {
        coords: {
            latitude: 42.332,
            longitude: -73.324,
        },
        name: 'Montr�al',
    };
    const tampa = {
        coords: {
            latitude: 27.9478,
            longitude: -82.4584,
        },
        name: 'Tampa',
    };
    function getCityInfo(city) {
        const coords = `(${city.coords.latitude.toFixed(3)}, ${city.coords.longitude.toFixed(3)})`;
        return `${city.name.toUpperCase()} is located at ${coords}.`;
    }
    console.log('[Exercise 2.3]', `${getCityInfo(montreal)} \n\n ${getCityInfo(tampa)}`);
    class User {
        constructor(name, id) {
            this.name = name;
            this.id = id;
        }
    }
    const user = new User('Dog', 1);
    console.log(user.id); // readable
    user.name = 'Harold'; // writable
    //user.id = 5; // not writable
    console.log(`User:`, user);
};
