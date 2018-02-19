'use strict';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Question from './Question';

/** 
 * Main questionnaire component
 * This component grabs all the questions passed by laravel in global variable __questions__
 * This components will take care of rendering all the Question component instances.
 * 1 for each element in window.__questions__
*/
export default class Questionnaire extends Component {
    constructor() {
        super();
        this.state = {
            questions: [],
            answers: new Map(),
            submitted: false
        }
        this.postQuestionnaire = this.postQuestionnaire.bind(this);
    }

    /** 
     * POSTs question to Laravel backend if all questions have been answered
     * @returns {void}
    */
    postQuestionnaire() {
        if (this.isReadyToSubmit()) {
            const axios = window.axios;
            axios.post('/questionnaire', {
                answers: Array.from(this.state.answers.values())
            }).then((response) => {
                alert('Your answers were submitted successfully!');
                this.setState({
                    // answers: new Map(window.__questions__.map(question => [question.id, null])),
                    submitted: true
                });

            }).catch((err) => {
                alert('Error: ' + err.toString());
            });
        } else {
            alert('Please answer all questions before continuing');
        }
    }

    /** 
     * @returns {Boolean} Whether all questions have been answered
    */
    isReadyToSubmit() {
        for (let answer of this.state.answers.values()) {
            if (answer === null) {
                return false;
            }
        }

        return true;
    }

    /**
     * Renders a questions (and its possible answers)
     * @param {Object} question 
     * @returns {Object} JSX Object
     */
    renderQuestion(question) {
        let props = {...question};
        props.selectedAnswerId = this.state.answers.get(question.id);
        props.submitted = this.state.submitted;
        props.answerSelected = (questionId, answerId) => {
            this.state.answers.set(questionId, answerId);
            this.setState({
                answers: new Map(this.state.answers) // mutate
            });
        };
        return (
            <Question {...props} />
        );
    }

    componentDidMount() {
      this.setState({
          questions: window.__questions__,
          answers: new Map(window.__questions__.map(question => [question.id, null]))
      });
    }

    renderSubmitButton() {
        if (this.state.submitted === false) {
            return (
                <button className='btn btn-danger btn-submit-questionnaire' onClick={this.postQuestionnaire}>Submit Questionnaire</button>
            );
        } else {
            return null;
        }
    }

    render() {
        return (
            <div className="container">
                <div className="row justify-content-center">
                    <div className="col-md-8">
                        <div className="card card-default">
                            <div className="card-header">Questionnaire</div>
                            <div className="card-body">
                                {this.state.questions.map(question => this.renderQuestion(question))}
                                {this.renderSubmitButton()}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

if (document.getElementById('reactapp')) {
    ReactDOM.render(<Questionnaire />, document.getElementById('reactapp'));
}
