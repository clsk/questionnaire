'use strict';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Answer from './Answer';

/** 
 * Component in charge of Rendering questions.
 * This component will render an Answer component
 * for each element in props.answers
*/
export default class Question extends Component {
  constructor() {
    super();
  }

  /**
   * Renders an answer
   * @param {Object} answer 
   * @param {boolean} isSelected 
   * @return {Object} JSX object for an answer
   */
  renderAnswer(answer, isSelected) {
    let props = {...answer};
    props.isSelected = isSelected;
    props.submitted = this.props.submitted;
    props.key = answer.id;
    props.answerSelected = (id) => {
      // Propagate up
      this.props.answerSelected(this.props.id, id);
    };

    return (
      <Answer {...props} />
    );
  }

  render() {
    return (
      <div>
        <h3>{this.props.text}</h3>
        <div>
          {this.props.answers.map((answer, index) => this.renderAnswer(answer, this.props.selectedAnswerId === answer.id))}
        </div>
      </div>
    );
  }
}