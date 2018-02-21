'use strict';

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import {Bar} from 'react-chartjs-2';

export default class DashboardQuestion extends Component {
  constructor(props) {
    super(props);
    this.state = {
      chartData: {
        labels: props.answers.map((answer) => answer.text),
        datasets: [
          {
            backgroundColor: [
              'rgba(255, 99, 132, 0.2)',
              'rgba(54, 162, 235, 0.2)',
              'rgba(255, 206, 86, 0.2)',
              'rgba(75, 192, 192, 0.2)',
              'rgba(153, 102, 255, 0.2)',
              'rgba(255, 159, 64, 0.2)',
              'rgba(3, 45, 64, 0.2)'
            ],
            borderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(3, 45, 64, 1)'
            ],
            borderWidth: 1,
            hoverBackgroundColor: [
              'rgba(255, 99, 132, 0.4)',
              'rgba(54, 162, 235, 0.4)',
              'rgba(255, 206, 86, 0.4)',
              'rgba(75, 192, 192, 0.4)',
              'rgba(153, 102, 255, 0.4)',
              'rgba(255, 159, 64, 0.4)',
              'rgba(3, 45, 64, 0.4)'
            ],
            hoverBorderColor: [
              'rgba(255,99,132,1)',
              'rgba(54, 162, 235, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(3, 45, 64, 1)'
            ],
            data: props.answers.map((answer) => answer.count)
          }
        ]
      }
    }
  }

  render() {
    return (
      <div className='dashboard-question-container'>
        <h3 className='dashboard-question-header'>{this.props.text}</h3>
        <Bar
          data={this.state.chartData}
          options={{maintainAspectRatio: false, legend: {display: false}}}
        />
      </div>
    );
  }
}