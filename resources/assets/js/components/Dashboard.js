'use strict';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Bar} from 'react-chartjs-2';
import DashboardQuestion from './DashboardQuestion';

export default class Dashboard extends Component {
  renderQuestion(question) {
    question.key = question.id;
    return (<DashboardQuestion {...question}/>);
  }
  
  render() {
    return (
      <div>
        {Object.entries(this.props.summary).map(([key, question]) => this.renderQuestion(question))}
      </div>
    );
  }
}