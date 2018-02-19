'use strict';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';

/** 
 * Component in charge of rendering a possible answer.
 * Will propagate click event up in the hierarchy Answer->Question->Questionnaire
*/
export default class Answer extends Component {
  constructor() {
    super();
    this.buttonClicked = this.buttonClicked.bind(this);
  }

  /** 
   * Invoked when the user selects this answer
   * The event is propagated up in the hierarchy
   * Note: Redux would make this cleaner
  */
  buttonClicked() {
    this.props.answerSelected(this.props.id);
  }

  render() {
    return (
      <button 
        className={`btn btn-answer ${this.props.isSelected ? 'btn-success' : 'btn-primary'}`}
        onClick={this.buttonClicked}
      >
        {this.props.text}
      </button>
    );
  }
}