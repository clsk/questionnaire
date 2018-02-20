import Answer from '../components/Answer';
import React from 'react';

describe('Answer', () => {
  test('Callback is called when answer is selected and Questionnaire has not been submitted', () => {
    let callback = jest.fn();
    const props = {id: 5, text: 'Some answer', answerSelected: callback, submitted: false};

    const wrapper = mount(
        (<Answer {...props}/>)
    );
    const button = wrapper.find('button');
    expect(button.length).toBe(1);
    button.simulate('click');
    expect(callback.mock.calls.length).toBe(1);
  });
});

describe('Answer', () => {
  test('Callback is NOT called when answer is selected and Questionnaire has already been submitted', () => {
    let callback = jest.fn();
    const props = {id: 5, text: 'Some answer', answerSelected: callback, submitted: true};

    const wrapper = mount(
        (<Answer {...props}/>)
    );
    const button = wrapper.find('button');
    expect(button.length).toBe(1);
    button.simulate('click');
    expect(callback.mock.calls.length).toBe(0);
  });
});

describe('Answer', () => {
  test('Make sure answer button is green when selected', () => {
    let callback = jest.fn();
    const props = {id: 5, text: 'Some answer', answerSelected: callback, submitted: false, isSelected: true};

    const wrapper = mount(
        (<Answer {...props}/>)
    );
    const button = wrapper.find('button');
    expect(button.length).toBe(1);
    expect(button.hasClass('btn-success')).toBe(true);
  });
});

describe('Answer', () => {
  test('Make sure answer button is blue when not selected', () => {
    let callback = jest.fn();
    const props = {id: 5, text: 'Some answer', answerSelected: callback, submitted: false, isSelected: false};

    const wrapper = mount(
        (<Answer {...props}/>)
    );
    const button = wrapper.find('button');
    expect(button.length).toBe(1);
    expect(button.hasClass('btn-primary')).toBe(true);
  });
});
