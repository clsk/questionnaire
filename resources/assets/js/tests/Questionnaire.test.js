import Questionnaire from '../components/Questionnaire';
import React from 'react';

describe('Questionnaire', () => {
  test('Questionnaire renders questions passed in props', () => {

    const questions = [{"id":1,"text":"what did you do this morning?","answers":[{"id":1,"text":"nothing","question_id":1},{"id":2,"text":"had breakfast","question_id":1},{"id":3,"text":"went for a run","question_id":1},{"id":4,"text":"went straight to work","question_id":1}]},{"id":2,"text":"what did you have for breakfast today?","answers":[{"id":5,"text":"eggs","question_id":2},{"id":6,"text":"muffins","question_id":2},{"id":7,"text":"sandwich","question_id":2},{"id":8,"text":"coffee","question_id":2}]},{"id":3,"text":"how do you feel today?","answers":[{"id":9,"text":"very good","question_id":3},{"id":10,"text":"good","question_id":3},{"id":11,"text":"ok","question_id":3},{"id":12,"text":"bad","question_id":3},{"id":13,"text":"very bad","question_id":3}]},{"id":4,"text":"how many miles did you run this morning?","answers":[{"id":14,"text":"0 mi","question_id":4},{"id":15,"text":"0.5 mi","question_id":4},{"id":16,"text":"1 - 3 mi","question_id":4},{"id":17,"text":"3 - 5 mi","question_id":4},{"id":18,"text":"5 - 10 mi","question_id":4}]}];
    const props = {questions};

    const wrapper = mount(
        (<Questionnaire {...props}/>)
    );
    // Make sure all questions are rendered
    expect(wrapper.find('Question')).toHaveLength(questions.length);
  });
});

