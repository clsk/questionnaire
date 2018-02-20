import Question from '../components/Question';
import React from 'react';

describe('Question', () => {
  test('Question renders answers passed in props', () => {
    const answers = [{"id":1,"text":"nothing","question_id":1},{"id":2,"text":"had breakfast","question_id":1},{"id":3,"text":"went for a run","question_id":1},{"id":4,"text":"went straight to work","question_id":1}];
    const props = {answers};

    const wrapper = mount(
        (<Question {...props}/>)
    );

    // Make sure all answers are rendered
    expect(wrapper.find('Answer')).toHaveLength(answers.length);
  });
});
