
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes React and other helpers. It's a great starting point while
 * building robust, powerful web applications using React + Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh React component instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import ReactDOM from 'react-dom';
import React from 'react';
import Questionnaire from './components/Questionnaire';
import Dashboard from './components/Dashboard';

if (document.getElementById('reactapp')) {

    // Note: The best way to do this would be using react-router or something similar.
    // Using this simple if/else here since cases aren't very complex.
    if (typeof __questions__ !== 'undefined') {
        // Grabs all the questions passed by Laravel in global variable __questions__
        let props = {questions: window.__questions__};
        ReactDOM.render(<Questionnaire {...props} />, document.getElementById('reactapp'));
    } else if (typeof __summary__ !== 'undefined') {
        // Grabs summary data passed by Laravel in global variable __summary__
        let props = {summary: window.__summary__};
        ReactDOM.render(<Dashboard {...props} />, document.getElementById('reactapp'));
    }
}
